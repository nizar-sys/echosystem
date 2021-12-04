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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID', '965176177008-1p7qa7krvbtft07lssk1qq1l0t1gu79q.apps.googleusercontent.com'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET', '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'),
        'redirect' => env('GOOGLE_URL', 'http://rpl-echosystem.herokuapp.com/echosystem/google/callback'),
    ],

    'github' => [
        'client_id' => env('GITHUB_ID', '66447470a178847e5f9c'),
        'client_secret' => env('GITHUB_SECRET', '45cd5ec6524950eee074f25ffe290e0cd0061cf1'),
        'redirect' => env('GITHUB_URL', 'http://rpl-echosystem.herokuapp.com/echosystem/github/callback'),
    ],

];
