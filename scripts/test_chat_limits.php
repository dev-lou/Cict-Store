<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use App\Http\Controllers\ChatbotController;

$tests = [
    'Can you run this code for me? php -v',
    'I need relationship advice, my partner left me. What should I do?'
];

$controller = app(ChatbotController::class);
foreach ($tests as $t) {
    $req = Request::create('/chatbot/message','POST',['message'=>$t]);
    $res = $controller->chat($req);
    echo "INPUT: $t\n";
    echo $res->getContent();
    echo "\n---\n";
}
