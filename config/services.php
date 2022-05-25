<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    
    'facebook' => [
        'client_id' => '1160382491406988',
        'client_secret' => 'f40ba469a508269e102c8afd248a2c9e',
        'redirect' => 'http://127.0.0.1:8000/admin/callback'

    ],

    'google' => [
        'client_id' => '632349918444-m7e0olni0pptlnoiukajdmdsm073d7k6.apps.googleusercontent.com',
        'client_secret'=>'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',
        'redirect' => 'http://127.0.0.1:8000/google/callback'

    ],

];
