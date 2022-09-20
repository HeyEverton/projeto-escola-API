<?php

namespace App\Services;

use App\Events\ForgotPassword;
use App\Events\UserRegistered;
use App\Exceptions\{LoginInvalidException, ResetPasswordTokenInvalidException, UserHasBeenTakenException, VerifyEmailTokenInvalidException};
use App\Http\Requests\AuthVerifyEmailRequest;
use App\Models\User;
use Illuminate\Support\Str;

class AuthService
{
    public function login(string $email, string $senha)
    {

        dd('oi');

        // $login = [
        //     'email' => $email,
        //     'senha' => $senha
        // ];
        // if (!$token = auth()->attempt($login)) {
        //     throw new LoginInvalidException();
        // }

        // return [
        //     'access_token' => $token,
        //     'token_type' => 'Bearer',
        // ];
    }

    public function register(string $name, string $email, string $password)
    {
        $user = User::where('email', $email)->exists();
        $token = Str::random(60);
        if (!empty($user)) {
            // throw new UserHasBeenTakenException();
        }
        $userPassword = bcrypt($password ?? Str::random(10));
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $userPassword,
        ]);

        return $user;
    }
}
