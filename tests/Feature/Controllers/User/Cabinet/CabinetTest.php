<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('requires authentication', function () {
    get(route('cabinet.index'))->assertRedirect('/login');
});

it(
    'returns the cabinet dashboard component for authenticated user',
    function () {
        actingAs(User::factory()->create())
            ->get(route('cabinet.index'))
            ->assertOk()
            ->assertComponent('User/Cabinet/Dashboard');
    }
);
