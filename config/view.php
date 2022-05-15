<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => [
        resource_path('views'),
        realpath(base_path('/src/UI')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),

    'variables' => [
        'home' => [
            'title' => config('app.name'),
            'themeColor' => '#0D1117',
            'description' => 'I am a web developer from Brazil that works with Laravel and PHP.',
            'author' => 'Gabriel Fonseca',
            'keywords' => 'developer, backend, php, laravel',
        ],
    ],

];
