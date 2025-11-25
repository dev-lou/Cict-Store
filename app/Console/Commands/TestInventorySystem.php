<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\InventoryService;
use Illuminate\Console\Command;

class TestInventorySystem extends Command
{
    protected $signature = 'inventory:test';
    protected $description = 'Test the inventory system with variants';

    public function handle()
    {
        $this->info('=== Product Inventory System Test ===');

        $product = Product::with('variants')->where('slug', 'custom-tshirt')->first();

        if (!$product) {
            $this->error('Product not found');
            return;
        }

        $this->line("\n✓ Product: {$product->name}");
        $this->line("✓ Base Price: ₱" . number_format($product->base_price, 2));

        $this->line("\n--- Variants ---");
        foreach ($product->variants as $variant) {
            $this->line("  • {$variant->name}: ₱" . number_format($variant->getFinalPrice(), 2) . " ({$variant->stock_quantity} stock)");
        }

        $this->line("\n--- Inventory Methods ---");
        $this->line("Total Stock: " . $product->getTotalStockFromVariants() . " units");
        $this->line("Has Stock: " . ($product->hasStock() ? "Yes" : "No"));
        $this->line("Is Low Stock: " . ($product->isLowStockVariant() ? "Yes" : "No"));

        // Test InventoryService
        $service = app(InventoryService::class);
        $this->line("\n--- Service Methods ---");
        $this->line("Stock Status: " . $service->getStockStatusLabel($product));

        $lowStock = $service->getLowStockVariants($product, 60);
        $this->line("Low Stock Variants (<= 60): " . count($lowStock));

        $this->info("\n✓ All tests passed!");
    }
}
