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
        Schema::create('inventory_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->string('type', 50);
            $table->integer('quantity_changed');
            $table->integer('quantity_before');
            $table->integer('quantity_after');
            $table->string('reference')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('product_id');
            $table->index('user_id');
            $table->index('type');
            $table->foreign('product_id')
                ->references('id')
                ->on('products');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_history');
    }
};
