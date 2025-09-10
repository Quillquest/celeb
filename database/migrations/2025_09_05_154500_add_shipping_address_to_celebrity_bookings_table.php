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
        Schema::table('celebrity_bookings', function (Blueprint $table) {
            // Add dedicated shipping address column for fan card orders
            $table->text('shipping_address')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('celebrity_bookings', function (Blueprint $table) {
            $table->dropColumn('shipping_address');
        });
    }
};