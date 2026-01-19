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
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'price_bw')) {
                $table->renameColumn('price_bw', 'price_primary');
            }
            if (Schema::hasColumn('services', 'price_color')) {
                $table->renameColumn('price_color', 'price_secondary');
            }
        });

        Schema::table('service_options', function (Blueprint $table) {
            if (Schema::hasColumn('service_options', 'price_bw')) {
                $table->renameColumn('price_bw', 'price_primary');
            }
            if (Schema::hasColumn('service_options', 'price_color')) {
                $table->renameColumn('price_color', 'price_secondary');
            }
            if (Schema::hasColumn('service_options', 'price_bw_label')) {
                $table->renameColumn('price_bw_label', 'price_primary_label');
            }
            if (Schema::hasColumn('service_options', 'price_color_label')) {
                $table->renameColumn('price_color_label', 'price_secondary_label');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'price_primary')) {
                $table->renameColumn('price_primary', 'price_bw');
            }
            if (Schema::hasColumn('services', 'price_secondary')) {
                $table->renameColumn('price_secondary', 'price_color');
            }
        });

        Schema::table('service_options', function (Blueprint $table) {
            if (Schema::hasColumn('service_options', 'price_primary')) {
                $table->renameColumn('price_primary', 'price_bw');
            }
            if (Schema::hasColumn('service_options', 'price_secondary')) {
                $table->renameColumn('price_secondary', 'price_color');
            }
            if (Schema::hasColumn('service_options', 'price_primary_label')) {
                $table->renameColumn('price_primary_label', 'price_bw_label');
            }
            if (Schema::hasColumn('service_options', 'price_secondary_label')) {
                $table->renameColumn('price_secondary_label', 'price_color_label');
            }
        });
    }
};
