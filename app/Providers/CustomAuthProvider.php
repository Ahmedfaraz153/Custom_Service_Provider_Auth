<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Guards\EmployeeGuard;

class CustomAuthProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
     
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Auth::extend('employee', function ($app, $name, array $config) {
            return new EmployeeGuard(
                "employee",
                Auth::createUserProvider($config['provider']),
                $app->make('session.store'),
                $app->make('request'),
            );
        });
    }
}
