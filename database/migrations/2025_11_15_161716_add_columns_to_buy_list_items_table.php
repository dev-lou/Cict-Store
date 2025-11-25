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
        Schema::table('buy_list_items', function (Blueprint $table) {
            $table->decimal('estimated_price_min', 10, 2)->nullable()->after('quantity');
            $table->decimal('estimated_price_max', 10, 2)->nullable()->after('estimated_price_min');
            $table->boolean('is_bought')->default(false)->after('estimated_price_max');
            $table->text('notes')->nullable()->after('is_bought');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buy_list_items', function (Blueprint $table) {
            //
        });
    }
};
