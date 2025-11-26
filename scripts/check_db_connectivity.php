<?php

/**
 * Simple script to test DB host DNS and TCP connectivity from the running container/server.
 * Usage: php scripts/check_db_connectivity.php
 */

function safeDnsA($host) {
    $a = @dns_get_record($host, DNS_A);
    return $a ?: [];
}

function safeDnsAAAA($host) {
    $a = @dns_get_record($host, DNS_AAAA);
    return $a ?: [];
}

function testTcpConnect($ip, $port, $isIpv6 = false) {
    $address = $isIpv6 ? "[$ip]" : $ip;
    $errno = 0; $errstr = '';
    $fp = @fsockopen($ip, $port, $errno, $errstr, 3);
    if ($fp) {
        fclose($fp);
        return [true, null];
    }
    return [false, trim("$errno: $errstr")];
}

// Determine host and port. Prefer explicit DB_HOST, else parse DATABASE_URL.
$envHost = getenv('DB_HOST');
$envPort = getenv('DB_PORT');
$databaseUrl = getenv('DATABASE_URL');

if ($envHost) {
    $host = $envHost;
    $port = $envPort ?: 5432;
} elseif ($databaseUrl) {
    $parts = parse_url($databaseUrl);
    $host = $parts['host'] ?? 'localhost';
    $port = $parts['port'] ?? 5432;
} else {
    $host = 'localhost';
    $port = 5432;
}

echo "Testing DB host: $host:$port\n";
echo "CONFIG: DB_HOST env: ".($envHost ?: 'none')."; DB_PORT env: ".($envPort ?: 'none')."; DATABASE_URL present: ".($databaseUrl ? 'yes' : 'no')."\n";
echo "CONFIG: app config db host: " . (getenv('APP_DB_HOST') ?: (getenv('DB_HOST') ?: 'none')) . "\n";

$a = safeDnsA($host);
$aaaa = safeDnsAAAA($host);

echo "A records (IPv4):\n";
foreach ($a as $r) {
    $ip = $r['ip'] ?? '';
    echo " - $ip: ";
    [$ok, $err] = testTcpConnect($ip, $port, false);
    echo $ok ? "OK\n" : "FAIL ($err)\n";
}

echo "AAAA records (IPv6):\n";
foreach ($aaaa as $r) {
    $ip = $r['ipv6'] ?? '';
    echo " - $ip: ";
    [$ok, $err] = testTcpConnect($ip, $port, true);
    echo $ok ? "OK\n" : "FAIL ($err)\n";
}

echo "Attempt direct connect to hostname (system default resolution): ";
[$ok, $err] = testTcpConnect($host, $port, false);
echo $ok ? "OK\n" : "FAIL ($err)\n";

// Test Supabase REST API if keys present and respond
$anon = getenv('SUPABASE_ANON_KEY');
$serviceKey = getenv('SUPABASE_SERVICE_ROLE_KEY');
$projectRef = getenv('AWS_ACCESS_KEY_ID') ?: getenv('SUPABASE_PROJECT_REF');
if ($projectRef && ($anon || $serviceKey)) {
    $key = $serviceKey ?: $anon;
    echo "Testing Supabase REST endpoint using key: " . ($serviceKey ? 'service_role' : 'anon') . "\n";
    $baseUrl = "https://{$projectRef}.supabase.co/rest/v1/products?select=id&limit=1";
    $headers = [
        'apikey' => $key,
        'Authorization' => 'Bearer ' . $key,
    ];
    $opts = [
        'http' => [
            'method' => 'GET',
            'header' => "apikey: {$key}\r\nAuthorization: Bearer {$key}\r\nAccept: application/json\r\n",
            'timeout' => 5,
        ],
    ];
    $context = stream_context_create($opts);
    $res = @file_get_contents($baseUrl, false, $context);
    if ($res === false) {
        echo "Supabase REST: UNAVAILABLE\n";
    } else {
        echo "Supabase REST: OK\n";
    }
} else {
    echo "Supabase REST: keys not configured (SUPABASE_ANON_KEY or SUPABASE_SERVICE_ROLE_KEY)\n";
}

echo "Script finished.\n";
