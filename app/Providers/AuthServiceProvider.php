<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('admin', function (User $user) {
            return $user->role === 'IT';
        });

        Gate::define('update-ticket', function (User $user, Ticket $ticket) {
            return $user->id === $ticket->user_id || $user->role === 'IT';
        });

        Gate::define('take-ticket', function (User $user, $department) {
            $user = User::where('id', auth()->id())->value('role');
            return $user === $department;
        });

        Gate::define('update-department', function (User $user,Department $department) {
            return $user->id === $department->user_id || $user->role === 'IT';
        });
    }
}
