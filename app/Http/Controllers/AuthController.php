<?php

namespace App\Http\Controllers;

use App\Http\Requests\{
    AuthForgotPasswordRequest,
    AuthLoginRequest,
    AuthRegisterRequest,
    AuthResetPasswordRequest,
    AuthVerifyEmailRequest
};
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    public function login(AuthLoginRequest $request)
    {
        $input = $request->validated();
        $token = $this->authService
            ->login($input['email'], $input['password']);

        return (new UserResource(auth()->user()))->additional($token);
    }

    public function register(AuthRegisterRequest $request)
    {

        $input = $request->validated();
        $user = $this->authService->register($input, $request);
        return new UserResource($user);
    }

    public function verifyEmail(AuthVerifyEmailRequest $request)
    {
        $input = $request->validated();
        $user =  $this->authService->verifyEmail($input['token']);
        return new UserResource($user);
    }


    public function forgotPassword(AuthForgotPasswordRequest $request)
    {
        $input = $request->validated();
        return $this->authService->forgotPassword($input['email']);
    }

    public function resetPassword(AuthResetPasswordRequest $request)
    {
        $input = $request->validated();
        return $this->authService->resetPassword($input['email'], $input['password'], $input['token']);
    }

    public function me(Request $request)
    {
        return $request->user();
    }

}
