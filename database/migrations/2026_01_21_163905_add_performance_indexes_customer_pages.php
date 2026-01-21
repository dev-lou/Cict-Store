<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Optimize review queries by product and rating
            $table->index(['product_id', 'rating'], 'reviews_product_rating_idx');
            // Optimize user review lookups
            $table->index(['user_id', 'product_id'], 'reviews_user_product_idx');
        });

        Schema::table('products', function (Blueprint $table) {
            // Optimize product search queries
            $table->index('name', 'products_name_idx');
            // Optimize badge filtering
            $table->index('badge_text', 'products_badge_idx');
        });

        Schema::table('notifications', function (Blueprint $table) {
            // Optimize notification queries
            $table->index(['user_id', 'created_at'], 'notifications_user_created_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropIndex('reviews_product_rating_idx');
            $table->dropIndex('reviews_user_product_idx');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('products_name_idx');
            $table->dropIndex('products_badge_idx');
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->dropIndex('notifications_user_created_idx');
        });
    }
};
