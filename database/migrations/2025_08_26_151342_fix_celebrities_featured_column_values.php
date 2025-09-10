<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FixCelebritiesFeaturedColumnValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update existing featured values to be boolean-like
        // Convert 'featured' string to '1' and everything else to '0'
        DB::statement("UPDATE celebrities SET featured = CASE 
            WHEN featured = 'featured' THEN '1' 
            ELSE '0' 
            END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert back to original string values
        DB::statement("UPDATE celebrities SET featured = CASE 
            WHEN featured = '1' THEN 'featured' 
            ELSE NULL 
            END");
    }
}
