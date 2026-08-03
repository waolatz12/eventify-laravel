<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage; // Add this import
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\URL;
use App\Models\User;
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
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // //only organizers and admins can create events
        // Gate::define('create-event', function ($user) {
        //     return in_array(
        //         $user->role,
        //         [
        //             UserRole::ADMIN,
        //             UserRole::ORGANIZER
        //         ]
        //     );
        // });

        Gate::define(
            'create-event',
            function (User $user) {

                if (
                    in_array(
                        $user->role,
                        [
                            // 'admin',
                            // 'organizer'
                            UserRole::ADMIN,
                            UserRole::ORGANIZER
                        ]
                    )
                ) {

                    return Response::allow();
                }


                return Response::deny(
                    'Only organizers or administrators can create events.'
                );
            }
        );


        // Gate::define('access-admin-dashboard', function ($user) {
        //     return $user->role === UserRole::ADMIN;
        // });

        // Gate::define('export-reports', function ($user) {
        //     return $user->role === UserRole::ADMIN;
        // });

        Gate::define(
            'access-admin-dashboard',
            function (User $user) {

                if (
                    $user->role === UserRole::ADMIN
                ) {

                    return Response::allow();
                }


                return Response::deny(
                    'You do not have permission to access the admin dashboard.'
                );
            }
        );



        Gate::define(
            'export-report',
            function (User $user) {

                if (
                    in_array(
                        $user->role,
                        [
                            UserRole::ADMIN,
                            UserRole::ORGANIZER
                        ]
                    )
                ) {

                    return Response::allow();
                }


                return Response::deny(
                    'Only organizers or administrators can export reports.'
                );
            }
        );

        // // 2. Add the custom verification URL logic directly underneath
        // VerifyEmail::createUrlUsing(function ($notifiable) {
        //     $frontendUrl = config('app.frontend_url') ?? 'https://frontend.test';

        //     $verifyUrl = URL::temporarySignedRoute(
        //         'verification.verify',
        //         now()->addMinutes(config('auth.verification.expire', 60)),
        //         [
        //             'id' => $notifiable->getKey(),
        //             'hash' => sha1($notifiable->getEmailForVerification()),
        //         ]
        //     );

        //     $signature = parse_url($verifyUrl, PHP_URL_QUERY);

        //     return "{$frontendUrl}/email-verify?{$signature}";
        // });

        // // 2. (NEW) Direct Laravel to use your custom HTML blade template
        // VerifyEmail::toMailUsing(function ($notifiable, $url) {
        //     return (new MailMessage)
        //         ->subject('Verify Your Eventify Account') // Custom subject line
        //         ->view('emails.verify-email', [
        //             'url' => $url, // The custom SPA URL generated above
        //             'user' => $notifiable // The User model instance
        //         ]);
        // });
    }
}
