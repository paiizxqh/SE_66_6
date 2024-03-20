<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('AdminRole', function ($user) {
            return $user->hasRole('Admin');
        });

        Gate::define('ManagerRole', function ($user) {
            return $user->hasRole('Manager');
        });

        Gate::define('SalesRole', function ($user) {
            return $user->hasRole('Sales');
        });

        Gate::define('AssistantRole', function ($user) {
            return $user->hasRole('Assistant');
        });

        Gate::define('SurveyorRole', function ($user) {
            return $user->hasRole('Surveyor');
        });

        Gate::define('AcademicianRole', function ($user) {
            return $user->hasRole('Academician');
        });
    }
}
