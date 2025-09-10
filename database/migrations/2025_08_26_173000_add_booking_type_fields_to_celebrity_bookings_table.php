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
            // Add new booking type column
            $table->enum('booking_type', ['booking', 'donation', 'fan_card'])->default('booking')->after('booking_reference');
            
            // Add new client info columns (more explicit naming)
            $table->string('client_name')->nullable()->after('booking_type');
            $table->string('client_email')->nullable()->after('client_name');
            $table->string('client_phone')->nullable()->after('client_email');
            
            // Add notes field for storing JSON data specific to booking types
            $table->text('notes')->nullable()->after('admin_notes');
            
            // Add cancellation reason field
            $table->text('cancellation_reason')->nullable()->after('notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('celebrity_bookings', function (Blueprint $table) {
            $table->dropColumn([
                'booking_type',
                'client_name',
                'client_email', 
                'client_phone',
                'notes',
                'cancellation_reason'
            ]);
        });
    }
};