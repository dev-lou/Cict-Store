<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClearOldAndAddVariants extends Seeder
{
    public function run(): void
    {
        // Delete old products
        DB::table('products')->whereIn('slug', [
            'custom-tshirt-s', 'custom-tshirt-m', 'custom-tshirt-l', 'custom-tshirt-xl',
            'usb-flash-4gb', 'usb-flash-8gb', 'usb-flash-16gb', 'usb-flash-32gb',
            'custom-tshirt', 'usb-flash-drive'
        ])->delete();

        // Add T-Shirt as single product
        $tshirtId = DB::table('products')->insertGetId([
            'name' => 'Custom T-Shirt',
            'slug' => 'custom-tshirt',
            'description' => 'Premium cotton t-shirt with custom print - choose your preferred size',
            'current_stock' => 210,
            'base_price' => 180.00,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Add T-Shirt variants
        DB::table('product_variants')->insert([
            ['product_id' => $tshirtId, 'name' => 'Small (S)', 'size' => 'S', 'price_modifier' => 0.00, 'stock_quantity' => 50, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => $tshirtId, 'name' => 'Medium (M)', 'size' => 'M', 'price_modifier' => 0.00, 'stock_quantity' => 60, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => $tshirtId, 'name' => 'Large (L)', 'size' => 'L', 'price_modifier' => 0.00, 'stock_quantity' => 55, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => $tshirtId, 'name' => 'Extra Large (XL)', 'size' => 'XL', 'price_modifier' => 20.00, 'stock_quantity' => 45, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Add USB Flash Drive as single product
        $usbId = DB::table('products')->insertGetId([
            'name' => 'USB Flash Drive',
            'slug' => 'usb-flash-drive',
            'description' => 'USB flash drive with custom branding - choose your storage capacity',
            'current_stock' => 420,
            'base_price' => 80.00,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Add USB variants
        DB::table('product_variants')->insert([
            ['product_id' => $usbId, 'name' => '4GB', 'size' => '4GB', 'price_modifier' => 0.00, 'stock_quantity' => 120, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => $usbId, 'name' => '8GB', 'size' => '8GB', 'price_modifier' => 40.00, 'stock_quantity' => 110, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => $usbId, 'name' => '16GB', 'size' => '16GB', 'price_modifier' => 100.00, 'stock_quantity' => 100, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => $usbId, 'name' => '32GB', 'size' => '32GB', 'price_modifier' => 200.00, 'stock_quantity' => 90, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);

        echo "✓ Updated products with variants successfully!\n";
    }
}
