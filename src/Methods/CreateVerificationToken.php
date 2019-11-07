<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;
use BrandStudio\Auth\Models\VerificationToken;
use BrandStudio\Auth\Jobs\DeleteVerificationTokenJob;

class CreateVerificationToken extends Base
{

    public static function execute(AuthService $authService, int $user_id, string $login, $password = null)
    {
        $token = VerificationToken::create([
            'user_id' => $user_id,
            'login' => $login,
            'token' => $authService->generateToken($login),
            'password' => $password,
        ]);

        $authService->deliverVerificationToken($token);
        DeleteVerificationTokenJob::dispatch($token)->delay(now()->addMinutes($authService->verification_token_lifetime));
    }

}
