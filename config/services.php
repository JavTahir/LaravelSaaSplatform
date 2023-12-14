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
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT_URI'),
    ],

    'linkedin-openid' => [
        'client_id' => '78bkphq6w4xwt7',
        'client_secret' =>'qePGg5VH7blVOgpt',
        'redirect' => 'http://localhost:8000/linkedin/callback',
        
    ],
    'twitter' => [
        'client_id' => 'Q8hgphorKWPA7LdYSOUTx8pAm',
        'client_secret' => 'NcpsIjVjL4F0g8NkqjMUX9cO3UB1UMvOGMZaNe3zAelshzMYTE',
        'redirect' => 'https://69ba-111-68-99-41.ngrok-free.app/twitter/callback',
    ],

];
