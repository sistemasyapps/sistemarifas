<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Email notifications
    |--------------------------------------------------------------------------
    */
    'email' => [
        'enabled' => env('NOTIFICATIONS_EMAIL_ENABLED', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | WhatsApp notifications
    |--------------------------------------------------------------------------
    */
    'whatsapp' => [
        'enabled' => env('NOTIFICATIONS_WHATSAPP_ENABLED', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Firebase push notifications
    |--------------------------------------------------------------------------
    */
    'firebase' => [
        'enabled' => env('NOTIFICATIONS_FIREBASE_ENABLED', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | SMS notifications
    |--------------------------------------------------------------------------
    |
    | Actualmente no existe implementación de SMS en el código, pero la bandera
    | se define para permitir una futura integración controlada por configuración.
    */
    'sms' => [
        'enabled' => env('NOTIFICATIONS_SMS_ENABLED', false),
    ],
];
