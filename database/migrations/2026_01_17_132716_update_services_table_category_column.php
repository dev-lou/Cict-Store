<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For PostgreSQL, we need to drop the enum type and recreate as varchar
        if (DB::getDriverName() === 'pgsql') {
            // First, add a temporary column
            Schema::table('services', function (Blueprint $table) {
                $table->string('category_temp')->nullable();
            });
            
            // Copy data to temp column
            DB::statement("UPDATE services SET category_temp = category::text");
            
            // Drop the old enum column
            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('category');
            });
            
            // Rename temp column to category
            Schema::table('services', function (Blueprint $table) {
                $table->renameColumn('category_temp', 'category');
            });
            
        } else {
            // For MySQL, just modify the column type
            Schema::table('services', function (Blueprint $table) {
                $table->string('category')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to enum (only for PostgreSQL rollback scenario)
        if (DB::getDriverName() === 'pgsql') {
            DB::statement("CREATE TYPE service_category_enum AS ENUM ('printing', 'paper_size')");
            Schema::table('services', function (Blueprint $table) {
            });
            DB::statement("ALTER TABLE services ALTER COLUMN category TYPE service_category_enum USING category::service_category_enum");
        } else {
            Schema::table('services', function (Blueprint $table) {
                $table->enum('category', ['printing', 'paper_size'])->default('printing')->change();
            });
        }
    }
};
