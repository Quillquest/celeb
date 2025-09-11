<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AppServiceProviderFallbackTest extends TestCase
{
    public function test_boot_falls_back_to_defaults_when_schema_throws()
    {
        // Make Schema::hasTable throw to simulate DB down/unavailable
        Schema::shouldReceive('hasTable')->andThrow(new \Exception('DB not available'));

        // Reboot application providers by calling bootstrappers that include providers
        $this->app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        // The view shared 'settings' should be present and be an object or array with default keys
        $shared = View::getShared();
        $this->assertArrayHasKey('settings', $shared);
        $this->assertNotNull($shared['settings']);
    }
}
