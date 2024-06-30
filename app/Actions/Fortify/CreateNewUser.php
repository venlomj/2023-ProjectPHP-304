<?php

namespace App\Actions\Fortify;

use App\Models\Role;
use App\Models\User;
use App\Models\Gender;
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'national_insurance_number' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'role_id' => ['required', 'exists:roles,id'],
            'gender_id' => ['required', 'exists:genders,id'],
            'phone_number' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'house_number' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'date_of_birth' => 'required|date|before:today',
        ])->validate();

        return User::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'national_insurance_number' => $input['national_insurance_number'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role_id' => $input['role_id'],
            'gender_id' => $input['gender_id'],
            'phone_number' => $input['phone_number'],
            'street' => $input['street'],
            'house_number' => $input['house_number'],
            'postal_code' => $input['postal_code'],
            'date_of_birth' => $input['date_of_birth'],
//            'is_admin' => $input['user_type'] == '1',
//            'is_financial' => $input['user_type'] == '2',
//            'is_chairman' => $input['user_type'] == '3',
        ]);
    }
}
