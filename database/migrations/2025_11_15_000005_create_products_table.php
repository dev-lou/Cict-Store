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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('current_stock')->default(0);
            $table->integer('low_stock_threshold')->default(10);
            $table->decimal('base_price', 10, 2);
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('status', 50)->default('active');
            $table->timestamps();
            
            $table->index('status');
            $table->index('slug');
            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
