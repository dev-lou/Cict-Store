<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProductSeeder::class,
        ]);
        // Create admin user
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'roles' => json_encode(['admin']),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create customer user
        DB::table('users')->insert([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'roles' => json_encode(['customer']),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create staff user
        DB::table('users')->insert([
            'name' => 'Staff Member',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
            'roles' => json_encode(['staff']),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create supplier
        DB::table('suppliers')->insert([
            'name' => 'ABC Supplies Inc.',
            'email' => 'contact@abcsupplies.com',
            'phone' => '555-0123',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create products
        DB::table('products')->insert([
            'name' => 'Colored Paper Pack',
            'slug' => 'colored-paper-pack',
            'description' => 'High quality colored printing paper',
            'current_stock' => 50,
            'base_price' => 12.99,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'name' => 'Glossy Photo Paper',
            'slug' => 'glossy-photo-paper',
            'description' => 'Premium glossy photo printing paper',
            'current_stock' => 30,
            'base_price' => 24.99,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'name' => 'Matte Paper',
            'slug' => 'matte-paper',
            'description' => 'Professional matte finish paper',
            'current_stock' => 25,
            'base_price' => 18.99,
            'supplier_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create product variants
        DB::table('product_variants')->insert([
            'product_id' => 1,
            'name' => 'A4 Size',
            'size' => 'A4',
            'price_modifier' => 0.00,
            'stock_quantity' => 50,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_variants')->insert([
            'product_id' => 2,
            'name' => 'Letter Size',
            'size' => 'Letter',
            'price_modifier' => 2.00,
            'stock_quantity' => 30,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_variants')->insert([
            'product_id' => 3,
            'name' => 'A3 Size',
            'size' => 'A3',
            'price_modifier' => 5.00,
            'stock_quantity' => 25,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
