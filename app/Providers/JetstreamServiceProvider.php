<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\DB;
use App\Models\Settings;
use Illuminate\Support\Facades\Log;

class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();
        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::loginView(function () {
            return view('auth.login', [
                'title' => 'Sign In to Continue',
                'settings' => Settings::where('id', '1')->first(),
            ]);
        });


        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            // Make Agent optional — the package was removed during upgrade in a previous step.
            $agent = null;
            if (class_exists('\Jenssegers\\Agent\\Agent')) {
                try {
                    $agent = new \Jenssegers\Agent\Agent();
                } catch (\Throwable $e) {
                    Log::warning('Failed to instantiate Agent: '.$e->getMessage());
                }
            }

            $passwordMatches = $user ? Hash::check($request->password, $user->password) : false;
            Log::info('Authenticate attempt', ['email' => $request->email, 'user_found' => (bool) $user, 'password_matches' => $passwordMatches]);

            if ($user && $passwordMatches) {
                $request->session()->put('getAnouc', 'true');
                try {
                    DB::table('activities')->insert([
                        'user' => $user->id,
                        'ip_address' => $request->ip(),
                        'device' => $agent ? $agent->device() : null,
                        'browser' => $agent ? $agent->browser() : null,
                        'os' => $agent ? $agent->platform() : null,
                    ]);
                } catch (\Throwable $e) {
                    Log::warning('Failed to record activity: '.$e->getMessage());
                }

                return $user;
            }
        });


        Fortify::registerView(function () {
            return view('auth.register', [
                'title' => 'Register an Account',
                'settings' => Settings::where('id', '1')->first(),
            ]);
        });
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
