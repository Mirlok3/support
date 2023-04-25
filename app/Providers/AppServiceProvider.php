<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $departments = DB::table('departments')->get();
        View::share('departments', $departments);

        view()->composer('*', function ($view)
        {
            $userRole = User::where('id', auth()->id())->value('role');
            $view->with('userRole', $userRole );
        });
    }
}
