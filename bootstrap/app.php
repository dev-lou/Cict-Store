<?php

use Illuminate\Foundation\Application;

/*
|--------------------------------------------------------------------------
| Parse DATABASE_URL for Neon PostgreSQL (SNI-compatible)
|--------------------------------------------------------------------------
| Neon requires `options=endpoint%3D<endpoint-id>` in the connection string
| for SNI. However, Laravel's ConfigurationUrlParser treats `options` as a
| config key and sets it to a string, which breaks PDO (expects an array).
|
| This block parses DATABASE_URL early (before config is loaded) and sets
| individual DB_* env vars. The `options` query param is appended to DB_HOST
| so it becomes part of the DSN (e.g., host=...;options=endpoint=...).
|--------------------------------------------------------------------------
*/
if (!empty($_ENV['DATABASE_URL']) || !empty($_SERVER['DATABASE_URL']) || !empty(getenv('DATABASE_URL'))) {
    $databaseUrl = $_ENV['DATABASE_URL'] ?? $_SERVER['DATABASE_URL'] ?? getenv('DATABASE_URL');
    $parsedUrl = parse_url($databaseUrl);
    
    if ($parsedUrl !== false) {
        // Extract query params (e.g., sslmode, options)
        $queryParams = [];
        if (!empty($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
        }
        
        // Build host string, appending options if present for Neon SNI
        $host = $parsedUrl['host'] ?? '127.0.0.1';
        if (!empty($queryParams['options'])) {
            // Append options to host so it becomes part of DSN: host=...;options=endpoint=...
            $host .= ';options=' . rawurldecode($queryParams['options']);
        }
        
        // Set individual env vars (these take precedence if not already set)
        if (empty($_ENV['DB_HOST']) && empty($_SERVER['DB_HOST'])) {
            $_ENV['DB_HOST'] = $host;
            $_SERVER['DB_HOST'] = $host;
            putenv("DB_HOST={$host}");
        }
        if (empty($_ENV['DB_PORT']) && empty($_SERVER['DB_PORT']) && !empty($parsedUrl['port'])) {
            $_ENV['DB_PORT'] = $parsedUrl['port'];
            $_SERVER['DB_PORT'] = $parsedUrl['port'];
            putenv("DB_PORT={$parsedUrl['port']}");
        }
        if (empty($_ENV['DB_DATABASE']) && empty($_SERVER['DB_DATABASE']) && !empty($parsedUrl['path'])) {
            $database = ltrim($parsedUrl['path'], '/');
            $_ENV['DB_DATABASE'] = $database;
            $_SERVER['DB_DATABASE'] = $database;
            putenv("DB_DATABASE={$database}");
        }
        if (empty($_ENV['DB_USERNAME']) && empty($_SERVER['DB_USERNAME']) && !empty($parsedUrl['user'])) {
            $_ENV['DB_USERNAME'] = $parsedUrl['user'];
            $_SERVER['DB_USERNAME'] = $parsedUrl['user'];
            putenv("DB_USERNAME={$parsedUrl['user']}");
        }
        if (empty($_ENV['DB_PASSWORD']) && empty($_SERVER['DB_PASSWORD']) && !empty($parsedUrl['pass'])) {
            $_ENV['DB_PASSWORD'] = $parsedUrl['pass'];
            $_SERVER['DB_PASSWORD'] = $parsedUrl['pass'];
            putenv("DB_PASSWORD={$parsedUrl['pass']}");
        }
        if (empty($_ENV['DB_SSLMODE']) && empty($_SERVER['DB_SSLMODE']) && !empty($queryParams['sslmode'])) {
            $_ENV['DB_SSLMODE'] = $queryParams['sslmode'];
            $_SERVER['DB_SSLMODE'] = $queryParams['sslmode'];
            putenv("DB_SSLMODE={$queryParams['sslmode']}");
        }
    }
}

$app = new Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$app->singleton(
    \Illuminate\Contracts\Debug\ExceptionHandler::class,
    \App\Exceptions\Handler::class
);

$app->singleton(
    \Illuminate\Contracts\Http\Kernel::class,
    \App\Http\Kernel::class
);

$app->singleton(
    \Illuminate\Contracts\Console\Kernel::class,
    \App\Console\Kernel::class
);

return $app;
