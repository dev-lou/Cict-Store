<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('service_options', 'is_active')) {
            Schema::table('service_options', function (Blueprint $table) {
                $table->boolean('is_active')->default(true)->after('sort_order');
            });
        }

        if (!Schema::hasColumn('service_options', 'price_primary_label')) {
            Schema::table('service_options', function (Blueprint $table) {
                $table->string('price_primary_label')->nullable()->after('price_secondary');
            });
        }

        if (!Schema::hasColumn('service_options', 'price_secondary_label')) {
            Schema::table('service_options', function (Blueprint $table) {
                $table->string('price_secondary_label')->nullable()->after('price_primary_label');
            });
        }
    }

    public function down(): void
    {
        Schema::table('service_options', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'price_primary_label', 'price_secondary_label']);
        });
    }
};
