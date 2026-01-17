<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations - Add composite indexes for performance.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Composite index for date + status filtering (common query pattern)
            $table->index(['created_at', 'status'], 'orders_created_status_idx');
            
            // Composite index for user orders lookup
            $table->index(['user_id', 'created_at'], 'orders_user_created_idx');
        });

        Schema::table('products', function (Blueprint $table) {
            // Composite index for low stock queries
            $table->index(['current_stock', 'low_stock_threshold'], 'products_stock_threshold_idx');
            
            // Index for status + stock filtering
            $table->index(['status', 'current_stock'], 'products_status_stock_idx');
        });

        Schema::table('order_items', function (Blueprint $table) {
            // Index for product sales analytics
            $table->index(['product_id', 'created_at'], 'order_items_product_created_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('orders_created_status_idx');
            $table->dropIndex('orders_user_created_idx');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('products_stock_threshold_idx');
            $table->dropIndex('products_status_stock_idx');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropIndex('order_items_product_created_idx');
        });
    }
};
