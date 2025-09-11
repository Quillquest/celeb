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
        // Compatibility registrations for Jetstream v3 published component views
        // Map x-jet-* component tags to the vendor-published Jetstream views
        if (class_exists(\Illuminate\Support\Facades\Blade::class)) {
            $map = [
                'jet-action-section' => 'vendor.jetstream.components.action-section',
                'jet-action-message' => 'vendor.jetstream.components.action-message',
                'jet-dialog-modal' => 'vendor.jetstream.components.dialog-modal',
                'jet-input' => 'vendor.jetstream.components.input',
                'jet-button' => 'vendor.jetstream.components.button',
                'jet-secondary-button' => 'vendor.jetstream.components.secondary-button',
                'jet-section-border' => 'vendor.jetstream.components.section-border',
                'jet-form-section' => 'vendor.jetstream.components.form-section',
                'jet-section-title' => 'vendor.jetstream.components.section-title',
                'jet-input-error' => 'vendor.jetstream.components.input-error',
                'jet-label' => 'vendor.jetstream.components.label',
                'jet-confirmation-modal' => 'vendor.jetstream.components.confirmation-modal',
                'jet-confirms-password' => 'vendor.jetstream.components.confirms-password',
                'jet-danger-button' => 'vendor.jetstream.components.danger-button',
                'jet-modal' => 'vendor.jetstream.components.modal',
                'jet-authentication-card-logo' => 'vendor.jetstream.components.authentication-card-logo',
                'jet-application-logo' => 'vendor.jetstream.components.application-logo',
            ];

            foreach ($map as $tag => $view) {
                \Illuminate\Support\Facades\Blade::component($view, $tag);
            }
        }

        // Livewire v3 compatibility: provide legacy emit(...) method expected by Jetstream v3 components
        if (class_exists(\Livewire\Component::class)) {
            \Livewire\Component::macro('emit', function ($event, ...$params) {
                return $this->dispatch($event, ...$params);
            });

            // Emit to a specific component (rough compatibility). Livewire v3 prefers dispatch/other APIs.
            \Livewire\Component::macro('emitTo', function ($name, $event, ...$params) {
                // In v3, dispatch can be used; fallback to dispatch with a special target if necessary
                return $this->dispatch($event, ...$params);
            });
        }
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

        // Safely attempt to load settings from DB. If the DB isn't available or
        // an error occurs, fall back to safe defaults so the application boot
        // process does not fail (useful during deployments, migrations, CI runs).
        try {
            if (Schema::hasTable((new Settings)->getTable())) {
                $settings = Settings::where('id', '1')->first() ?: $defaults;
                $terms = (Schema::hasTable((new TermsPrivacy)->getTable()) ? TermsPrivacy::find(1) : null);
                $moreset = (Schema::hasTable((new SettingsCont)->getTable()) ? SettingsCont::find(1) : null);
            } else {
                $settings = $defaults;
                $terms = null;
                $moreset = null;
            }
        } catch (\Throwable $e) {
            // Log the issue for visibility, but don't prevent the application from booting.
            \Illuminate\Support\Facades\Log::warning('AppServiceProvider boot: failed to load settings from DB: ' . $e->getMessage());
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
