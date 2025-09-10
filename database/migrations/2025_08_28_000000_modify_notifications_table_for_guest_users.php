<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyNotificationsTableForGuestUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // SQLite doesn't support dropping foreign keys; handle differently for sqlite.
        if (DB::getDriverName() === 'sqlite') {
            // If users table doesn't exist in sqlite test environments, skip the in-place change
            if (! Schema::hasTable('users')) {
                return;
            }

            Schema::table('notifications', function (Blueprint $table) {
                if (Schema::hasColumn('notifications', 'user_id')) {
                    // Just make the column nullable; foreign keys cannot be dropped on sqlite in-place
                    $table->unsignedBigInteger('user_id')->nullable()->change();
                }
            });
            return;
        }

        Schema::table('notifications', function (Blueprint $table) {
            // Drop the existing foreign key constraint if it exists (MySQL)
            try {
                if (DB::getDriverName() === 'mysql') {
                    $fk = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='notifications' AND COLUMN_NAME='user_id' AND REFERENCED_TABLE_NAME='users'");
                    if (! empty($fk)) {
                        $table->dropForeign(['user_id']);
                    }
                } else {
                    // For other drivers attempt to drop and let exceptions bubble if unexpected
                    $table->dropForeign(['user_id']);
                }
            } catch (\Exception $e) {
                // If dropping foreign key fails, continue — we only need to make the column nullable
            }

            // Modify user_id to be nullable
            $table->unsignedBigInteger('user_id')->nullable()->change();

            // Re-add the foreign key constraint but allow null values if users table exists
            if (Schema::hasTable('users')) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (DB::getDriverName() === 'sqlite') {
            Schema::table('notifications', function (Blueprint $table) {
                if (Schema::hasColumn('notifications', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable(false)->change();
                }
            });
            return;
        }

        Schema::table('notifications', function (Blueprint $table) {
            // Drop the foreign key if it exists
            try {
                if (DB::getDriverName() === 'mysql') {
                    $fk = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='notifications' AND COLUMN_NAME='user_id' AND REFERENCED_TABLE_NAME='users'");
                    if (! empty($fk)) {
                        $table->dropForeign(['user_id']);
                    }
                } else {
                    $table->dropForeign(['user_id']);
                }
            } catch (\Exception $e) {
                // ignore
            }

            // Make user_id not nullable again
            $table->unsignedBigInteger('user_id')->nullable(false)->change();

            // Re-add the original foreign key constraint if users table exists
            if (Schema::hasTable('users')) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }
}
