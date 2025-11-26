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

$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: 5432;

echo "Testing DB host: $host:$port\n";

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

echo "Script finished.\n";
