<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            // Define static token for testing
            // $token = '1234567890';

            // $header = $request->header('Api-Token');
            // if ($header && $header === $token) {
            //     // Return a User instance if the token matches
            //     return new User();
            // }

            // return null;

            // Cek token pada tabel users
            if ($request->header('api_token')) {
                return User::where('api_token', $request->header('api_token'))->first();
            }
        }); 
    }
}
