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
        Schema::create('buy_list_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('item_name');
            $table->integer('quantity')->default(1);
            $table->text('reason')->nullable();
            $table->string('priority', 50)->default('normal');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('status', 50)->default('pending');
            $table->string('receipt_path')->nullable();
            $table->timestamps();
            
            $table->index('status');
            $table->index('priority');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('set null');
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
        Schema::dropIfExists('buy_list_items');
    }
};
