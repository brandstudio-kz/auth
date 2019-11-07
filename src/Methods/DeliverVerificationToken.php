<?php

namespace BrandStudio\Auth\Methods;

use BrandStudio\Auth\AuthService;
use BrandStudio\Auth\Models\VerificationToken;
use BrandStudio\Auth\Jobs\SendSmsJob;
use BrandStudio\Auth\Jobs\SendMailJob;

class DeliverVerificationToken extends Base
{

    public static function execute(AuthService $authService, VerificationToken $token)
    {
        if ($authService->getAuthFieldType($token->login) == 'phone') {
            SendSmsJob::dispatch(
                $authService->sms_service,
                $token
            );
        } else {
            SendMailJob::dispatch(
                '\\BrandStudio\\Auth\\Mail\\MailConfirmationMail',
                $token
            );
        }

    }

}
