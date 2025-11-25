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
        Schema::table('inventory_history', function (Blueprint $table) {
            // Add variant_id column after product_id
            $table->unsignedBigInteger('variant_id')->nullable()->after('product_id');
            
            // Add foreign key for variant_id
            $table->foreign('variant_id')
                ->references('id')
                ->on('product_variants')
                ->onDelete('set null');
            
            // Add index on variant_id
            $table->index('variant_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory_history', function (Blueprint $table) {
            $table->dropForeign(['variant_id']);
            $table->dropIndex(['variant_id']);
            $table->dropColumn('variant_id');
        });
    }
};
