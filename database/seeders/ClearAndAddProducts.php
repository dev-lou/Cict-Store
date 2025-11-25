<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClearAndAddProducts extends Seeder
{
    public function run(): void
    {
        // Clear old products
        DB::table('products')->whereIn('slug', [
            'custom-mug', 'custom-tote-bag', 'custom-tumbler',
            'custom-tshirt-s', 'custom-tshirt-m', 'custom-tshirt-l', 'custom-tshirt-xl',
            'custom-umbrella', 'custom-stickers', 'custom-id-lace',
            'usb-flash-4gb', 'usb-flash-8gb', 'usb-flash-16gb', 'usb-flash-32gb'
        ])->delete();

        // Add new products
        $products = [
            ['name' => 'Custom Mug', 'slug' => 'custom-mug', 'description' => 'Personalized ceramic mug with custom design - perfect for gifts and daily use', 'stock' => 100, 'price' => 150.00],
            ['name' => 'Custom Tote Bag', 'slug' => 'custom-tote-bag', 'description' => 'Durable canvas tote bag with custom printing - eco-friendly and reusable', 'stock' => 80, 'price' => 200.00],
            ['name' => 'Custom Tumbler', 'slug' => 'custom-tumbler', 'description' => 'Stainless steel tumbler with custom design - keeps drinks hot or cold for hours', 'stock' => 90, 'price' => 250.00],
            ['name' => 'Custom T-Shirt (Size S)', 'slug' => 'custom-tshirt-s', 'description' => 'Premium cotton t-shirt with custom print - Size Small', 'stock' => 50, 'price' => 180.00],
            ['name' => 'Custom T-Shirt (Size M)', 'slug' => 'custom-tshirt-m', 'description' => 'Premium cotton t-shirt with custom print - Size Medium', 'stock' => 60, 'price' => 180.00],
            ['name' => 'Custom T-Shirt (Size L)', 'slug' => 'custom-tshirt-l', 'description' => 'Premium cotton t-shirt with custom print - Size Large', 'stock' => 55, 'price' => 180.00],
            ['name' => 'Custom T-Shirt (Size XL)', 'slug' => 'custom-tshirt-xl', 'description' => 'Premium cotton t-shirt with custom print - Size Extra Large', 'stock' => 45, 'price' => 200.00],
            ['name' => 'Custom Umbrella', 'slug' => 'custom-umbrella', 'description' => 'Durable umbrella with custom design - perfect for rainy days with personalized branding', 'stock' => 70, 'price' => 220.00],
            ['name' => 'Custom Stickers', 'slug' => 'custom-stickers', 'description' => 'High-quality vinyl stickers with custom design - waterproof and durable', 'stock' => 200, 'price' => 50.00],
            ['name' => 'Custom ID Lace', 'slug' => 'custom-id-lace', 'description' => 'Durable ID lace lanyard with custom design - perfect for ID badges and keychains', 'stock' => 150, 'price' => 35.00],
            ['name' => 'USB Flash Drive (4GB)', 'slug' => 'usb-flash-4gb', 'description' => '4GB USB flash drive with custom branding - perfect for data transfer and promotions', 'stock' => 120, 'price' => 80.00],
            ['name' => 'USB Flash Drive (8GB)', 'slug' => 'usb-flash-8gb', 'description' => '8GB USB flash drive with custom branding - more storage for files and media', 'stock' => 110, 'price' => 120.00],
            ['name' => 'USB Flash Drive (16GB)', 'slug' => 'usb-flash-16gb', 'description' => '16GB USB flash drive with custom branding - ideal for large files and projects', 'stock' => 100, 'price' => 180.00],
            ['name' => 'USB Flash Drive (32GB)', 'slug' => 'usb-flash-32gb', 'description' => '32GB USB flash drive with custom branding - maximum capacity for all your needs', 'stock' => 90, 'price' => 280.00],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'slug' => $product['slug'],
                'description' => $product['description'],
                'current_stock' => $product['stock'],
                'base_price' => $product['price'],
                'supplier_id' => 1,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        echo "✓ Added 14 merchandise products successfully!\n";
    }
}
