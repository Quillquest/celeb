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

        // Sharing settings with all view
        $settings = Settings::where('id', '1')->first();
        $terms =  TermsPrivacy::find(1);
        $moreset =  SettingsCont::find(1);

        View::share('settings', $settings);
        View::share('terms', $terms);
        View::share('moresettings', $moreset);
        View::share('mod', $settings->modules);
    }
}