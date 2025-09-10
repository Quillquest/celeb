<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('site_title')->nullable();
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->string('website_theme')->nullable();
            $table->string('enable_social_login')->default('no');
            $table->string('contact_email')->nullable();
            $table->json('modules')->nullable();
            $table->string('pp_ci')->nullable();
            $table->string('pp_cs')->nullable();
            $table->string('s_currency')->nullable();
            $table->string('google_translate')->nullable();
            $table->string('usertheme')->nullable();
            $table->string('currency')->nullable();
            $table->text('tawk_to')->nullable();
            $table->timestamps();
        });

        // Insert a default settings row to avoid null lookups in views/controllers during tests
        DB::table('settings')->insert([
            'site_name' => 'Celebrity',
            'site_title' => 'Celebrity',
            'favicon' => null,
            'logo' => null,
            'website_theme' => 'default',
            'enable_social_login' => 'no',
            'contact_email' => 'admin@example.com',
            'modules' => json_encode([]),
            'pp_ci' => null,
            'pp_cs' => null,
            's_currency' => 'USD',
            'google_translate' => null,
            'usertheme' => null,
            'currency' => 'USD',
            'tawk_to' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
