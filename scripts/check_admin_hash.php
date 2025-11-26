<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

$email = 'admin@example.com';
$user = DB::table('users')->where('email', $email)->first();

if (! $user) {
    echo "User not found: $email\n";
    exit(1);
}

echo "Found user id={$user->id} email={$user->email}\n";
echo "Stored password hash: {$user->password}\n";

$pw = 'password';
$ok = Hash::check($pw, $user->password);
echo "Hash::check('password') => ";
echo $ok ? "true\n" : "false\n";

// Print current app env and DB connection used
echo "APP_ENV=" . env('APP_ENV') . "\n";
echo "DB_CONNECTION=" . config('database.default') . "\n";
echo "DB_HOST=" . env('DB_HOST') . "\n";
