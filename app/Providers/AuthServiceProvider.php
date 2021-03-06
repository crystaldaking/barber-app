<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     * @var $user User
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-users',function ($user){
            return $user->hasAnyRoles(['admin','moderator']);
        });

        Gate::define('delete-users',function ($user){
            return $user->hasAnyRoles(['admin','moderator']);
        });

        Gate::define('manage-users',function ($user){
            return $user->hasAnyRoles(['admin','moderator']);
        });

    }
}
