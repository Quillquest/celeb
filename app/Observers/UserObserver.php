<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Settings;
use Illuminate\Support\Facades\Schema;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
        // If settings table doesn't exist (fresh test DB), skip observer logic
        if (! Schema::hasTable((new Settings)->getTable())) {
            return;
        }

        $settings = Settings::where('id', 1)->first();

        if ($settings && ($settings->enable_verification ?? 'true') == 'false') {
            $user->email_verified_at = \Carbon\Carbon::now();
            $user->save();
        }
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
