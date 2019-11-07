<?php

return [

    'model' => 'App\User',

    'auth_fields' => ['email', 'phone'],
    'password_field' => 'password',

    'password_requirements' => 'required|min:6',
    'login_requirements' => 'required',

    'verification_code_length' => 4,
    'verification_token_length' => 32,
    'sms_service' => 'BrandStudio\\Sms\\SmsService',

    'verification_token_lifetime' => 24*60,// in minutes

    'route_prefix' => 'auth',
];
