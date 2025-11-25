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
        (env('APP_ENV') === 'production' ? sys_get_temp_dir() . '/laravel-views' : storage_path('framework/views'))
    ),

    /*
    |--------------------------------------------------------------------------
    | Disable View Compilation (Serverless)
    |--------------------------------------------------------------------------
    |
    | For serverless environments like Vercel, we need to use pre-compiled
    | views and prevent runtime compilation due to read-only filesystem.
    |
    */

    'cache' => env('VIEW_CACHE_ENABLED', true),

];
