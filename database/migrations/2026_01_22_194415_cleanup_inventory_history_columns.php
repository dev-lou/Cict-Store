<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the old quantity_change column if it exists
        if (Schema::hasColumn('inventory_history', 'quantity_change')) {
            Schema::table('inventory_history', function (Blueprint $table) {
                $table->dropColumn('quantity_change');
            });
        }

        // Drop reason column if it exists (replaced by reference and notes)
        if (Schema::hasColumn('inventory_history', 'reason')) {
            Schema::table('inventory_history', function (Blueprint $table) {
                $table->dropColumn('reason');
            });
        }

        // Make quantity_changed NOT nullable if it's nullable
        DB::statement('ALTER TABLE inventory_history ALTER COLUMN quantity_changed DROP DEFAULT');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore old columns
        Schema::table('inventory_history', function (Blueprint $table) {
            if (!Schema::hasColumn('inventory_history', 'quantity_change')) {
                $table->integer('quantity_change')->nullable();
            }
            if (!Schema::hasColumn('inventory_history', 'reason')) {
                $table->text('reason')->nullable();
            }
        });
    }
};
