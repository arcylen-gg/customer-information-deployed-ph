<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    { 
        $this->app['auth']->viaRequest('api', function ($request) {
        $api_token = $request->header('api_token') ?? $request->input('api_token');
            if ($api_token) {
                return User::where('api_token', $api_token)->first();
            }
        });
    }
}
