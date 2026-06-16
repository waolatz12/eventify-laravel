<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Enums\UserRole;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //only organizers and admins can create events
        Gate::define('create-event', function ($user) {
            return in_array(
                $user->role,
                [
                    UserRole::ADMIN,
                    UserRole::ORGANIZER
                ]
            );
        });

        Gate::define('access-admin-dashboard', function ($user){
            return $user->role === UserRole::ADMIN;
        });

        Gate::define('export-reports', function ($user){
            return $user->role === UserRole::ADMIN;
        });
    }
}
