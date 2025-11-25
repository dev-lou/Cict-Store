<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Delete existing products to avoid conflicts
        DB::table('products')->whereIn('slug', [
            'custom-mug', 'custom-tote-bag', 'custom-tumbler',
            'custom-tshirt-s', 'custom-tshirt-m', 'custom-tshirt-l', 'custom-tshirt-xl',
            'custom-umbrella', 'custom-stickers', 'custom-id-lace',
            'usb-flash-4gb', 'usb-flash-8gb', 'usb-flash-16gb', 'usb-flash-32gb'
        ])->delete();
    }

    public function down(): void
    {
        //
    }
};
