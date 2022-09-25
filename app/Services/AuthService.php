<?php

namespace App\Services;

use App\Exceptions\{EmailHasBeenTaken, LoginInvalidException, ResetPasswordTokenInvalidException, VerifyEmailTokenInvalidException};
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    public function register(string $name, string $email, string $role, string $password)
    {
        $user = User::where('email', $email)->exists();
        $token = Str::random(60);
        if (!empty($user)) {
            throw new EmailHasBeenTaken();
        }
        $usuarioSenha = bcrypt($password ?? Str::random(10));
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $usuarioSenha,
            'role' => $role,
            'confirmation_token' => $token
        ]);

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

        // event(new ForgotPassword($user, $token));

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
