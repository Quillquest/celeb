<?php

namespace App\Providers;

use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;
use Illuminate\Support\Facades\View;
use App\Models\Settings;
use App\Models\SettingsCont;
use App\Models\TermsPrivacy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        FacadesStorage::extend('sftp', function ($app, $config) {
            // Prefer Flysystem v3 adapter if installed (namespace may vary by package)
            if (class_exists('League\\Flysystem\\SftpV3\\SftpAdapter') && class_exists('League\\Flysystem\\Filesystem')) {
                $adapterClass = 'League\\Flysystem\\SftpV3\\SftpAdapter';
                $filesystemClass = 'League\\Flysystem\\Filesystem';
                $adapter = new $adapterClass($config);
                return new $filesystemClass($adapter);
            }

            // Fall back to current v1 adapter
            if (class_exists(\League\Flysystem\Sftp\SftpAdapter::class)) {
                return new Filesystem(new SftpAdapter($config));
            }

            throw new \RuntimeException('No supported SFTP adapter is installed.');
        });

        Paginator::useBootstrap();

        // Sharing settings with all views — provide safe defaults when DB/table/row is missing
        $defaults = (object) [
            'site_name' => config('app.name', 'Application'),
            'favicon' => '',
            'logo' => '',
            'website_theme' => '',
            'enable_social_login' => 'no',
            'contact_email' => '',
            'modules' => null,
            'pp_ci' => '',
            'pp_cs' => '',
            's_currency' => 'USD',
            'google_translate' => 'off',
            'usertheme' => '',
            'currency' => '$',
            'tawk_to' => '',
        ];

        if (Schema::hasTable((new Settings)->getTable())) {
            $settings = Settings::where('id', '1')->first() ?: $defaults;
            $terms =  (Schema::hasTable((new TermsPrivacy)->getTable()) ? TermsPrivacy::find(1) : null);
            $moreset =  (Schema::hasTable((new SettingsCont)->getTable()) ? SettingsCont::find(1) : null);
        } else {
            $settings = $defaults;
            $terms = null;
            $moreset = null;
        }

        View::share('settings', $settings);
        View::share('terms', $terms);
        View::share('moresettings', $moreset);
        View::share('mod', $settings->modules ?? null);
    }
}
