<?php

return [
    'personal_information' => [
        'name' => env('USER_PERSONAL_INFORMATION_NAME', 'John Doe'),
    ],
    'social' => [
        'linkedin' => [
            'icon_path' => public_path('img/social/linkedin.svg'),
            'url' => env('USER_SOCIAL_LINKEDIN_URL', 'https://linkedin.com'),
        ],
        'github' => [
            'icon_path' => public_path('img/social/github.svg'),
            'url' => env('USER_SOCIAL_GITHUB_URL', 'https://github.com'),
        ],
        'dev' => [
            'icon_path' => public_path('img/social/dev.svg'),
            'url' => env('USER_SOCIAL_DEV_URL', 'https://dev.to'),
        ],
        'twitter' => [
            'icon_path' => public_path('img/social/twitter.svg'),
            'url' => env('USER_SOCIAL_TWITTER_URL', 'https://twitter.com'),
        ],
    ],
];
