<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Conversation\Dialogue;
use App\Policies\Conversation\DialoguePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Dialogue::class => DialoguePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
