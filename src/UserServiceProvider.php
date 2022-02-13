<?php

namespace OZiTAG\Tager\Backend\User;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Factory;
use OZiTAG\Tager\Backend\Auth\AuthServiceProvider;
use OZiTAG\Tager\Backend\User\Commands\RevokePasswordResetTokensCommand;
use OZiTAG\Tager\Backend\User\Enums\PasswordValidationRule;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(AuthServiceProvider::class);
    }

    public function boot(Factory $validator)
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/tager-user.php', 'tager-user'
        );

        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'tager-user');

        $this->loadRoutes();

        $this->registerValidationRules($validator);
    }

    protected function loadRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        if (is_file(base_path('routes/users.php'))) {
            Route::prefix('users')
                ->middleware(['passport:users', 'auth:api'])
                ->group(base_path('routes/users.php'));
        }

        if (is_file(base_path('routes/user.php'))) {
            Route::prefix('user')
                ->middleware(['passport:users', 'auth:api'])
                ->group(base_path('routes/user.php'));
        }
    }

    protected function bootCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                RevokePasswordResetTokensCommand::class,
            ]);
        }

        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
            $schedule->command('revoke_password_reset_tokens')->everyMinute();
        });
    }

    protected function registerValidationRules(Factory $validator)
    {
        $validator->extend(PasswordValidationRule::HasCaseDiff->value, function ($attribute, $value, $parameters, $validator) {
            return preg_match('/(\p{Ll}+.*\p{Lu})|(\p{Lu}+.*\p{Ll})/u', $value);
        }, __('tager-user::messages.rule_case_diff'));

        $validator->extend(PasswordValidationRule::HasLetters->value, function ($attribute, $value, $parameters, $validator) {
            return preg_match('/\pL/', $value);
        }, __('tager-user::messages.rule_letters'));

        $validator->extend(PasswordValidationRule::HasNumbers->value, function ($attribute, $value, $parameters, $validator) {
            return preg_match('/\pN/', $value);
        }, __('tager-user::messages.rule_numbers'));

        $validator->extend(PasswordValidationRule::HasSymbols->value, function ($attribute, $value, $parameters, $validator) {
            return preg_match('/\p{Z}|\p{S}|\p{P}/', $value);
        }, __('tager-user::messages.rule_symbols'));
    }
}
