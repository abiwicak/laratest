<?php

namespace App\Providers;

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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            foreach ($user->roles as $role){
                return $role->name == 'Administrator';
            }
        });
        Gate::define('editor', function ($user) {
            foreach ($user->roles as $role){
                return $role->name == 'Editor';
            }
        });
        Gate::define('self', function ($user, $self) {
                return $user->id == $self->id;
        });
    }
}
