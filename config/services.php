<?php

return [
    'slack' => [
        'token' => env('SLACK_TOKEN'),
        'ssl_verify' => false,

        'channels' => 'all',
    ],
];
