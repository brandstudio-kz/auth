<?php

namespace BrandStudio\Auth\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use BrandStudio\Auth\Http\Requests\RegisterRequest;
use BrandStudio\Auth\Http\Requests\LoginRequest;
use BrandStudio\Auth\Http\Requests\ResetPasswordRequest;
use BrandStudio\Auth\Http\Requests\UpdatePasswordRequest;
use BrandStudio\Auth\Http\Requests\VerifyTokenRequest;
use Illuminate\Http\Request;
use BrandStudio\Auth\Facades\BsAuth;

class AuthController extends BaseController
{

    public function getUser(Request $request)
    {
        return response()->json($request->user);
    }

    public function register(RegisterRequest $request)
    {
        return BsAuth::register($request->login, $request->password, \Arr::except($request->toArray(), ['login', 'password']));
    }

    public function login(LoginRequest $request)
    {
        return BsAuth::login($request->login, $request->password);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        return BsAuth::resetPassword($request);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        return BsAuth::updatePassword($request);
    }

    public function updateLogin(UpdateLoginRequest $request)
    {
        return BsAuth::updateLogin($request->user, $request->login, $request->password);
    }

    public function verify(VerifyTokenRequest $request)
    {
        return BsAuth::verify($request);
    }

}
