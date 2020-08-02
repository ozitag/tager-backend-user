<?php

namespace OZiTAG\Tager\Backend\User;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Events\AccessTokenCreated;
use Laravel\Passport\Token;
use Laravel\Passport\Passport;
use OZiTAG\Tager\Backend\User\Listeners\UserAuthListener;
use OZiTAG\Tager\Backend\User\Observers\TokenObserver;

class UserServiceProvider extends EventServiceProvider
{
    protected $listen = [
        AccessTokenCreated::class => [
            UserAuthListener::class
        ],
    ];

    public function register()
    {
        $this->app->register(\OZiTAG\Tager\Backend\Auth\TagerBackendAuthServiceProvider::class);
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        if (is_file(base_path('routes/users.php'))) {
            Route::prefix('admin')
                ->middleware(['provider:users', 'auth:api'])
                ->group(base_path('routes/users.php'));
        }

        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
    }
}
