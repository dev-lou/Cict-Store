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
        Schema::table('inventory_history', function (Blueprint $table) {
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('inventory_history', 'reference')) {
                $table->string('reference')->nullable();
            }
            if (!Schema::hasColumn('inventory_history', 'notes')) {
                $table->text('notes')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory_history', function (Blueprint $table) {
            if (Schema::hasColumn('inventory_history', 'reference')) {
                $table->dropColumn('reference');
            }
            if (Schema::hasColumn('inventory_history', 'notes')) {
                $table->dropColumn('notes');
            }
        });
    }
};
