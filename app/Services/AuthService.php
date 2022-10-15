<?php

namespace App\Services;

use App\Events\ForgotPassword;
use App\Events\UserRegistered;
use App\Exceptions\{EmailHasBeenTaken, LoginInvalidException, ResetPasswordTokenInvalidException, VerifyEmailTokenInvalidException};
use App\Http\Requests\AuthRegisterRequest;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class AuthService
{
    public function login(string $email, string $password)
    {

        $login = [
            'email' => $email,
            'password' => $password
        ];

        if (!$token = auth()->attempt($login)) {
            throw new LoginInvalidException();
        }

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
    }

    public function register(array $input, AuthRegisterRequest $request)
    {
        $user = User::where('email', $input['email'])->exists();
        $token = Str::random(60);
        if (!empty($user)) {
            throw new EmailHasBeenTaken();
        }
        $data = $request->all();
        $fotoPerfil = $request->file('profile_photo');
        if ($fotoPerfil) {
            if ($request->file('profile_photo')->isValid()) {
                $extensaoArquivo = $fotoPerfil->getClientOriginalExtension();
                $nomeArquivo = Uuid::uuid6() . "." . "{$extensaoArquivo}";
                $fotoPerfil->storeAs('public/perfis', $nomeArquivo);
                $data['profile_photo'] = $nomeArquivo;
                $data['password'] = bcrypt($data['password']);
                $data['confirmation_token'] = Str::random(60);
            }
        }
        $user = User::create($data);
        event(new UserRegistered($user));
        return $user;

    }

    public function verifyEmail(string $token)
    {
        $user = User::where('confirmation_token', $token)->first();
        if (empty($user)) {
            throw new VerifyEmailTokenInvalidException();
        }
        $user->confirmation_token = null;
        $user->email_verified_at = now();
        $user->save();

        return $user;
    }

    public function forgotPassword(string $email)
    {
        $user = User::where('email', $email)->firstOrFail();

        $token = Str::random(60);

        PasswordReset::create([
            'email' => $user->email,
            'token' => $token,
        ]);

        event(new ForgotPassword($user, $token));

        return '';
    }

    public function resetPassword(string $email, string $password, string $token)
    {
        $passReset = PasswordReset::where('email', $email)->where('token', $token)->first();
        if (empty($passReset)) {
            throw new ResetPasswordTokenInvalidException();
        }

        $user = User::where('email', $email)->firstOrFail();
        $user->password = bcrypt($password);
        $user->save();

        PasswordReset::where('email', $email)->delete();

        return '';
    }
}
