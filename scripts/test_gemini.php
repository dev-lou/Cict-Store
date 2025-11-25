<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$service = app(App\Services\GeminiChatService::class);
$result = $service->chat('hello from test script');
file_put_contents(__DIR__ . '/test_gemini_result.json', json_encode($result, JSON_PRETTY_PRINT));
print_r($result);
