<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mug
        DB::table('products')->insert([
            'name' => 'Custom Mug',
            'slug' => 'custom-mug',
            'description' => 'Personalized ceramic mug with custom design - perfect for gifts and daily use',
            'current_stock' => 100,
            'base_price' => 150.00,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tote Bag
        DB::table('products')->insert([
            'name' => 'Custom Tote Bag',
            'slug' => 'custom-tote-bag',
            'description' => 'Durable canvas tote bag with custom printing - eco-friendly and reusable',
            'current_stock' => 80,
            'base_price' => 200.00,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tumbler
        DB::table('products')->insert([
            'name' => 'Custom Tumbler',
            'slug' => 'custom-tumbler',
            'description' => 'Stainless steel tumbler with custom design - keeps drinks hot or cold for hours',
            'current_stock' => 90,
            'base_price' => 250.00,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // T-Shirt Size S
        DB::table('products')->insert([
            'name' => 'Custom T-Shirt (Size S)',
            'slug' => 'custom-tshirt-s',
            'description' => 'Premium cotton t-shirt with custom print - Size Small',
            'current_stock' => 50,
            'base_price' => 180.00,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // T-Shirt Size M
        DB::table('products')->insert([
            'name' => 'Custom T-Shirt (Size M)',
            'slug' => 'custom-tshirt-m',
            'description' => 'Premium cotton t-shirt with custom print - Size Medium',
            'current_stock' => 60,
            'base_price' => 180.00,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // T-Shirt Size L
        DB::table('products')->insert([
            'name' => 'Custom T-Shirt (Size L)',
            'slug' => 'custom-tshirt-l',
            'description' => 'Premium cotton t-shirt with custom print - Size Large',
            'current_stock' => 55,
            'base_price' => 180.00,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // T-Shirt Size XL
        DB::table('products')->insert([
            'name' => 'Custom T-Shirt (Size XL)',
            'slug' => 'custom-tshirt-xl',
            'description' => 'Premium cotton t-shirt with custom print - Size Extra Large',
            'current_stock' => 45,
            'base_price' => 200.00,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Umbrella
        DB::table('products')->insert([
            'name' => 'Custom Umbrella',
            'slug' => 'custom-umbrella',
            'description' => 'Durable umbrella with custom design - perfect for rainy days with personalized branding',
            'current_stock' => 70,
            'base_price' => 220.00,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Stickers
        DB::table('products')->insert([
            'name' => 'Custom Stickers',
            'slug' => 'custom-stickers',
            'description' => 'High-quality vinyl stickers with custom design - waterproof and durable',
            'current_stock' => 200,
            'base_price' => 50.00,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID Lace
        DB::table('products')->insert([
            'name' => 'Custom ID Lace',
            'slug' => 'custom-id-lace',
            'description' => 'Durable ID lace lanyard with custom design - perfect for ID badges and keychains',
            'current_stock' => 150,
            'base_price' => 35.00,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // USB 4GB
        DB::table('products')->insert([
            'name' => 'USB Flash Drive (4GB)',
            'slug' => 'usb-flash-4gb',
            'description' => '4GB USB flash drive with custom branding - perfect for data transfer and promotions',
            'current_stock' => 120,
            'base_price' => 80.00,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // USB 8GB
        DB::table('products')->insert([
            'name' => 'USB Flash Drive (8GB)',
            'slug' => 'usb-flash-8gb',
            'description' => '8GB USB flash drive with custom branding - more storage for files and media',
            'current_stock' => 110,
            'base_price' => 120.00,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // USB 16GB
        DB::table('products')->insert([
            'name' => 'USB Flash Drive (16GB)',
            'slug' => 'usb-flash-16gb',
            'description' => '16GB USB flash drive with custom branding - ideal for large files and projects',
            'current_stock' => 100,
            'base_price' => 180.00,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // USB 32GB
        DB::table('products')->insert([
            'name' => 'USB Flash Drive (32GB)',
            'slug' => 'usb-flash-32gb',
            'description' => '32GB USB flash drive with custom branding - maximum capacity for all your needs',
            'current_stock' => 90,
            'base_price' => 280.00,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
