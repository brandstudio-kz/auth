<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;

class ResetPassword extends Base
{

    public static function execute(AuthService $authService, string $login)
    {
        $user = $authService->getUser($login);
        $authService->createVerificationToken($user->id, $login, $authService->generatePassword());
    }

}
