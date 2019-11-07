<?php

return [

    'route_prefix' => 'auth',

    'model' => 'App\User',
    'auth_fields' => ['email', 'phone'],

    'password_requirements' => 'required|min:6',
    'login_requirements' => 'required',

    'new_password_length' => 6,
    'verification_code_length' => 4,
    'verification_token_length' => 32,
    'verification_token_lifetime' => 24*60,// in minutes

    'sms_service' => 'BrandStudio\\Sms\\SmsService',
];
