<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'game_username' => 'required|string|min:3|max:15|regex:/^[A-Za-z0-9]+$/|unique:users',
            'email' => 'required|string|email:filter|max:255|unique:users',
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature()
                ? ['accepted', 'required']
                : '',
        ])->validate();

        return User::create([
            'game_username' => $input['game_username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
