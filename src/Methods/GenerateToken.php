<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GenerateToken extends Base
{

    public static function execute(AuthService $authService, string $login)
    {
        if ($authService->getAuthFieldType($login) == 'phone') {
            return rand(10 ** ($authService->verification_code_length + 1), 10 ** $authService->verification_code_length - 1);
        }
        return Str::random($authService->verification_token_length);
    }

}
