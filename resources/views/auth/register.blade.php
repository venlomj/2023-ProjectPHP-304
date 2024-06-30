@php use App\Models\Gender;use App\Models\Role;
$roles = Role::whereIn('id', [5, 6])->get();
$genders = Gender::all();
@endphp
<x-hockeyclub-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo/>
        </x-slot>

        <x-validation-errors class="mb-4"/>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="first_name" value="{{ __('Voornaam') }}"/>
                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                         :value="old('first_name')" required autofocus autocomplete="first_name"/>
            </div>
            <div>
                <x-label for="last_name" value="{{ __('Achternaam') }}"/>
                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')"
                         required autofocus autocomplete="last_name"/>
            </div>
            <div>
                <x-label for="national_insurance_number" value="{{ __('Rijksregisternummer') }}"/>
                <x-input id="national_insurance_number" class="block mt-1 w-full" type="text"
                         name="national_insurance_number" :value="old('national_insurance_number')" required autofocus
                         autocomplete="national_insurance_number"/>
            </div>
            <div>
                <x-label for="phone_number" value="{{ __('Telefoon') }}"/>
                <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                         :value="old('phone_number')" required autofocus autocomplete="phone_number"/>
            </div>
            <div>
                <x-label for="street" value="{{ __('Straat') }}"/>
                <x-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street')" required
                         autofocus autocomplete="street"/>
            </div>
            <div>
                <x-label for="house_number" value="{{ __('Huisnummer') }}"/>
                <x-input id="house_number" class="block mt-1 w-full" type="text" name="house_number"
                         :value="old('house_number')" required autofocus autocomplete="house_number"/>
            </div>
            <div>
                <x-label for="postal_code" value="{{ __('Postcode') }}"/>
                <x-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code"
                         :value="old('postal_code')" required autofocus autocomplete="postal_code"/>
            </div>
            <div>
                <x-label for="date_of_birth" value="{{ __('Geboortedatum') }}"/>
                <x-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth"
                         :value="old('date_of_birth')" required autofocus autocomplete="date_of_birth"/>
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}"/>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                         autocomplete="username"/>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}"/>
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                         autocomplete="new-password"/>
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                         name="password_confirmation" required autocomplete="new-password"/>
            </div>
            <div class="mt-4">
                <x-smod.form.select name="gender_id" :value="old('gender_id')" id="gender_id">
                    <option value="gender_d">Gender</option>
                    @foreach($genders as $gender)
                        <option value="{{ $gender->id }}">{{ $gender->name}}</option>
                    @endforeach
                </x-smod.form.select>
            </div>
            <div class="mt-4">
                <x-smod.form.select name="role_id" :value="old('role_id')" id="role_id">
                    <option value="">Type gebruiker</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->type }}</option>
                    @endforeach
                </x-smod.form.select>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-hockeyclub-layout>
