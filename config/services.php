<?php

return [
    'slack' => [
        'token' => env('SLACK_TOKEN'),
        'ssl_verify' => false,

        'channels' => 'all',
        'resend' => env('SLACK_RESEND_INVITATION'),
    ],
];
