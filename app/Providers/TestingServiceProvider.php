<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia;

class TestingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (!$this->app->runningUnitTests()) {
            return;
        }

        TestResponse::macro("assertComponent", function (
            string $component,
            bool $shouldExit = true
        ) {
            return $this->assertInertia(
                fn(AssertableInertia $inertia) => $inertia->component(
                    $component,
                    $shouldExit
                )
            );
        });
    }
}
