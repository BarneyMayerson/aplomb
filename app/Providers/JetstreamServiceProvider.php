<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::loginView(function () {
            return Inertia::modal('Auth/Login', [
                'canResetPassword' => Route::has('password.reset'),
                'status' => session('status'),
            ])->baseRoute('home');
        });

        Fortify::registerView(function () {
            return Inertia::modal('Auth/Register')->baseRoute('home');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return Inertia::modal('Auth/ForgotPassword', [
                'status' => session('status'),
            ])->baseRoute('home');
        });

        Fortify::resetPasswordView(function (Request $request) {
            return Inertia::modal('Auth/ResetPassword', [
                'email' => $request['email'],
                'token' => $request['token'],
            ])->baseRoute('home');
        });
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions(['create', 'read', 'update', 'delete']);
    }
}
