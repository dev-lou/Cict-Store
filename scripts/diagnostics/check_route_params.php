<?php
// Simple script to find named routes that require parameters and views that call them without parameters.

$routesFile = __DIR__ . '/../routes/web.php';
$viewsPath = __DIR__ . '/../resources/views';

if (!file_exists($routesFile)) {
    fwrite(STDERR, "routes/web.php not found\n");
    exit(1);
}

$routesContent = file($routesFile, FILE_IGNORE_NEW_LINES);
$parameterized = [];

// collect named routes with braces in their uri lines
foreach ($routesContent as $i => $line) {
    if (preg_match("/->name\(['\"]([a-z0-9_\.]+)['\"]\)/i", $line, $m)) {
        // look back up to 4 lines to find a route uri that contains '{'
        // Find the nearest previous line containing the actual Route:: definition
        $hasParam = false;
        for ($j = $i; $j >= 0 && $j >= $i - 10; $j--) {
            $candidate = $routesContent[$j] ?? '';
            if (stripos($candidate, 'Route::') !== false) {
                // inspect this candidate for placeholder params like {id}
                if (preg_match('/\{[^}]+\}/', $candidate)) {
                    $hasParam = true;
                }
                break; // found the route definition line for this name
            }
        }

        if ($hasParam) {
            $parameterized[] = $m[1];
        }
    }
}

$parameterized = array_unique($parameterized);
if (empty($parameterized)) {
    echo "No parameterized routes found in routes/web.php\n";
    exit(0);
}

// Search views for usages of route('name') without parameters
$finder = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsPath));
$issues = [];
foreach ($finder as $file) {
    if ($file->isDir()) continue;
    if (!preg_match('/\.blade\.php$/', $file->getPathname())) continue;

    $lines = file($file->getPathname(), FILE_IGNORE_NEW_LINES);
    foreach ($lines as $ln => $text) {
        if (preg_match_all('/route\(\s*["\']([a-z0-9_\.]+)["\']\s*\)/i', $text, $matches)) {
            foreach ($matches[1] as $routeName) {
                if (in_array($routeName, $parameterized)) {
                    $issues[] = [
                        'file' => $file->getPathname(),
                        'line' => $ln + 1,
                        'route' => $routeName,
                        'text' => trim($text),
                    ];
                }
            }
        }
    }
}

if (empty($issues)) {
    echo "No view calls found that use parameterized routes without parameters.\n";
    exit(0);
}

echo "Found view usage of parameterized routes with no parameters (possible bugs):\n\n";
foreach ($issues as $issue) {
    echo "- {$issue['file']}:{$issue['line']} -> route '{$issue['route']}'\n    {$issue['text']}\n\n";
}

exit(1);
