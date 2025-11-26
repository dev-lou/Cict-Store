<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$c = $app->make('config')->get('database.connections.pgsql');
extract($c, EXTR_SKIP);
$host = isset($host) ? "host={$host};" : '';
$database = $database ?? null;
$port = $port ?? null;
$dsn = "pgsql:{$host}dbname='{$database}'";
if (! is_null($port)) $dsn .= ";port={$port}";
if (isset($charset)) $dsn .= ";client_encoding='{$charset}'";
if (isset($application_name)) $dsn .= ";application_name='".str_replace("'", "\\'", $application_name)."'";

foreach (['sslmode','sslcert','sslkey','sslrootcert'] as $option) {
    if (isset($c[$option])) $dsn .= ";{$option}={$c[$option]}";
}

echo $dsn.PHP_EOL;
