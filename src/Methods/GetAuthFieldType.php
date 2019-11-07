<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;

class GetAuthFieldType extends Base
{

    public static function execute(AuthService $authService, string $login) : string
    {
        return filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
    }

}
