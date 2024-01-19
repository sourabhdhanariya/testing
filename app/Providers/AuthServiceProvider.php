<?php

namespace App\Providers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Guards\AdminStatefulGuard;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
   
public function boot()
{
    $this->registerPolicies();

    Auth::extend('admin', function ($app, $name, array $config) {
        return new AdminStatefulGuard(
            Auth::createUserProvider($config['provider']),
            $app->make('session.store'),
            $app->make('request')
        );
    });
}}
