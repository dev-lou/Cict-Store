<?php
// Temporary debug endpoint - DELETE AFTER FIXING
// Visit: https://cictstore.me/debug-error.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>PHP Info</h2>";
echo "PHP Version: " . phpversion() . "<br>";
echo "PDO Drivers: " . implode(', ', PDO::getAvailableDrivers()) . "<br>";

echo "<h2>Environment</h2>";
echo "APP_ENV: " . ($_ENV['APP_ENV'] ?? getenv('APP_ENV') ?? 'not set') . "<br>";
echo "DB_HOST: " . ($_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? 'not set') . "<br>";
echo "DB_PORT: " . ($_ENV['DB_PORT'] ?? getenv('DB_PORT') ?? 'not set') . "<br>";
echo "DB_CONNECTION: " . ($_ENV['DB_CONNECTION'] ?? getenv('DB_CONNECTION') ?? 'not set') . "<br>";
echo "SESSION_DRIVER: " . ($_ENV['SESSION_DRIVER'] ?? getenv('SESSION_DRIVER') ?? 'not set') . "<br>";

echo "<h2>Database Connection Test</h2>";
try {
    $host = $_ENV['DB_HOST'] ?? getenv('DB_HOST');
    $port = $_ENV['DB_PORT'] ?? getenv('DB_PORT');
    $dbname = $_ENV['DB_DATABASE'] ?? getenv('DB_DATABASE');
    $user = $_ENV['DB_USERNAME'] ?? getenv('DB_USERNAME');
    $pass = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD');
    
    $dsn = "pgsql:host={$host};port={$port};dbname={$dbname};sslmode=require";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_EMULATE_PREPARES => true,
        PDO::ATTR_TIMEOUT => 5,
    ]);
    
    $result = $pdo->query("SELECT 1 as test")->fetch();
    echo "✅ Database connected! Result: " . $result['test'] . "<br>";
    
    // Check sessions table
    $tables = $pdo->query("SELECT tablename FROM pg_tables WHERE schemaname = 'public' AND tablename = 'sessions'")->fetchAll();
    echo "Sessions table: " . (count($tables) > 0 ? "✅ EXISTS" : "❌ MISSING") . "<br>";
    
} catch (\Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "<br>";
}

echo "<h2>Fatal Error Log</h2>";
$logFile = __DIR__ . '/../storage/logs/fatal.log';
if (file_exists($logFile)) {
    echo "<pre>" . htmlspecialchars(file_get_contents($logFile)) . "</pre>";
} else {
    echo "No fatal errors logged yet.<br>";
}

echo "<h2>Laravel Log (last 50 lines)</h2>";
$laravelLog = __DIR__ . '/../storage/logs/laravel.log';
if (file_exists($laravelLog)) {
    $lines = file($laravelLog);
    $last50 = array_slice($lines, -50);
    echo "<pre>" . htmlspecialchars(implode('', $last50)) . "</pre>";
} else {
    echo "No laravel.log found.<br>";
}
