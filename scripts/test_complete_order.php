<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Order;
use App\Models\InventoryHistory;

$orderId = 349;
$order = Order::find($orderId);

if (!$order) {
    echo "Order {$orderId} not found\n";
    exit(1);
}

echo "Order {$order->id} current status: {$order->status}\n";

if ($order->status === 'completed') {
    echo "Order already completed — aborting test.\n";
    exit(0);
}

try {
    $order->status = 'completed';
    $order->save();
    echo "Order updated to completed.\n";
    // Show last inventory_history entries for products involved
    foreach ($order->items as $item) {
        $productId = $item->product_id;
        $hist = InventoryHistory::where('product_id', $productId)->latest('id')->first();
        if ($hist) {
            echo "Inventory history for product {$productId}: id={$hist->id}, qty_changed={$hist->quantity_changed}, before={$hist->quantity_before}, after={$hist->quantity_after}, ref={$hist->reference}\n";
        } else {
            echo "No inventory history found for product {$productId}\n";
        }
    }
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}


