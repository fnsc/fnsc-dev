<?php

return [
    'authorized_user' => env('AUTHORIZED_USER_EMAIL'),

    'social_media' => [
        'linkedin' => [
            'name' => 'LinkedIn',
            'icon_path' => 'img/social/linkedin.svg',
            'profile_url' => env('USER_SOCIAL_LINKEDIN_URL', 'https://linkedin.com'),
        ],

        'github' => [
            'name' => 'GitHub',
            'icon_path' => 'img/social/github.svg',
            'profile_url' => env('USER_SOCIAL_GITHUB_URL', 'https://github.com'),
            'api' => [
                'url' => env('GITHUB_USER_ACCESS_URL', 'https://api.github.com/user'),
                'token' => env('GITHUB_API_ACCESS_TOKEN', ''),
            ],
        ],

        'dev' => [
            'name' => 'DEV Community',
            'icon_path' => 'img/social/dev.svg',
            'profile_url' => env('USER_SOCIAL_DEV_URL', 'https://dev.to'),
        ],

        'twitter' => [
            'name' => 'Twitter',
            'icon_path' => 'img/social/twitter.svg',
            'profile_url' => env('USER_SOCIAL_TWITTER_URL', 'https://twitter.com'),
        ],
    ],

];
