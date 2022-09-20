<?php

namespace App\Services;

use App\Exceptions\{EmailHasBeenTaken, LoginInvalidException};
use App\Models\User;
use Illuminate\Support\Str;

class AuthService
{
    public function login(string $email, string $senha)
    {

        $login = [
            'email' => $email,
            'senha' => $senha
        ];
        if (!$token = auth()->attempt($login)) {
            throw new LoginInvalidException();
        }

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
    }

    public function register(string $nome, string $email, string $senha, string $cargo)
    {
        $user = User::where('email', $email)->exists();
        // $token = Str::random(60);
        if (!empty($user)) {
            throw new EmailHasBeenTaken();
        }
        $usuarioSenha = bcrypt($senha ?? Str::random(10));
        $user = User::create([
            'nome' => $nome,
            'email' => $email,
            'senha' => $usuarioSenha,
            'cargo' => $cargo
        ]);

        return $user;
    }
}
