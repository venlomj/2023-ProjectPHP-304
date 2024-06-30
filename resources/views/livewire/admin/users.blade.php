@php
    use App\Models\Role;
    app()->setLocale(LC_TIME, 'nl_NL.utf8');
    $userTypes = Role::whereIn('id', [5,6])->get();
@endphp
<div>
    <div title="Gebruikers"></div>
    <div>
        <div class="fixed top-8 left-1/2 -translate-x-1/2 z-50 animate-pulse"
             wire:loading>
            {{--<x-smod.preloader class="px-1">
                {{ $loading }}
            </x-smod.preloader>--}}
        </div>
        <div class="my-4">{{ $users->links() }}</div>
        <div class="mb-4 flex flex-col lg:flex-row lg:items-center">
            <div class="w-full lg:w-1/2 lg:mr-2 mb-2 lg:mb-0">
                <x-input id="search" type="text" placeholder="Voornaam of Achternaam"
                         wire:model.debounce="search"
                         class="w-full shadow-md placeholder-gray-300"/>
            </div>
            <div class="w-full lg:w-1/4 lg:mr-2 mb-2 lg:mb-0">
                <x-smod.form.select name="roles" wire:model="role">
                    <option value="%">Type Gebruiker</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">
                            {{ $role->type }}
                        </option>
                    @endforeach
                </x-smod.form.select>
            </div>
            <div class="w-full lg:w-auto">
                <x-button type="button" class="bg-blue-500" wire:click="setNewUser()">Voeg gebruiker toe</x-button>
            </div>
        </div>

        <section>
        <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-8 items-start">
            @forelse($users as $user)
            <div class="flex flex-col bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden bg-blue-100 rounded-xl" wire:key="user_{{ $user->id }}">

                <div class="p-2 flex-1 flex gap-4">
                    <!-- display user profile image -->
                    <p>
                        <img class="rounded-full h-8 w-8 cursor-pointer"
                             src="https://ui-avatars.com/api/?name={{ urlencode($user->full_name) }}"
                             alt="{{$user->full_name}}">
                    </p>
                    <!-- display user info -->
                    <div class="flex-1 flex flex-col">
                        <h3 class="font-bold">{{$user->full_name}}</h3>
                        <p class="italic">{{ $user->email }}</p>
                        <p class="font-sm text-gray-400">{{ $user->street }} # {{ $user->house_number }} {{ $user->postal_code }} {{ $user->city }}</p>
                        <p class="font-sm text-gray-400">{{  \Carbon\Carbon::parse($user->date_of_birth)->formatLocalized('%e %B %Y') }}</p>
                    </div>
                </div>
                <!-- display edit and delete buttons -->
                <div class="p-2 bg-gray-100 border-t border-t-gray-300" x-data="">
                    <div class="flex space-x-4">
                        <div class="w-6 cursor-pointer hover:text-red-900">
                            <x-phosphor-pencil-line-duotone
                                class="w-5 text-blue-300 hover:text-green-600"
                                wire:click="setNewUser({{ $user->id }})"/>
                        </div>
                        <div class="w-6 cursor-pointer hover:text-red-900">
                            <x-phosphor-trash-duotone
                                class="w-6 text-orange-300 hover:text-red-600"
                                @click="$dispatch('swal:confirm', {
                            title: 'Verwijder {{ $user->first_name }} {{ $user->last_name }}?',
                            cancelButtonText: 'NEEN!',
                            confirmButtonText: 'Ja, verwijder deze gebruiker',
                            next: {
                                event: 'delete-user',
                                params: {
                                    id: {{ $user->id }}
                                }
                            }
                        });"/>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <!-- display a message if $users array is empty -->
                <div>
                    <div colspan="6" class="border-t border-gray-300 p-4 text-center text-gray-500">
                        <div class="font-bold italic text-sky-800">Geen gebruikers gevonden met de voornaam of achternaam {{$search}}</div>
                    </div>
                </div>
            @endforelse
        </div>
        </section>
        {{--End Users in  Cards--}}
        <div class="my-4">{{ $users->links() }}</div>

        <x-dialog-modal id="userModal"
                        wire:model="showModal">
            <x-slot name="title">
                <h2>{{ is_null($newUser['id']) ? 'Nieuwe gebruiker' : 'Bewerk gebruiker' }}</h2>
            </x-slot>
            <x-slot name="content">
                <h2>Voeg een gebruiker toe</h2>
                <di>
                    <x-slot name="logo">
                        <x-authentication-card-logo/>
                    </x-slot>

                    <x-validation-errors class="mb-4"/>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-label for="first_name" value="{{ __('Voornaam') }}"/>
                            <x-input id="first_name" class="block mt-1 w-full" type="text"
                                     wire:model.defer="newUser.first_name" required autofocus
                                     autocomplete="first_name"/>
                        </div>
                        <div>
                            <x-label for="last_name" value="{{ __('Achternaam') }}"/>
                            <x-input id="last_name" class="block mt-1 w-full" type="text"
                                     wire:model.defer="newUser.last_name" required autofocus autocomplete="last_name"/>
                        </div>
                        <div>
                            <x-label for="national_insurance_number" value="{{ __('Rijksregisternummer') }}"/>
                            <x-input id="national_insurance_number" class="block mt-1 w-full" type="text"
                                     wire:model.defer="newUser.national_insurance_number" required autofocus
                                     autocomplete="national_insurance_number"/>
                        </div>
                        <div>
                            <x-label for="phone_number" value="{{ __('Telefoon') }}"/>
                            <x-input id="phone_number" class="block mt-1 w-full" type="text"
                                     wire:model.defer="newUser.phone_number" required autofocus
                                     autocomplete="phone_number"/>
                        </div>
                        <div>
                            <x-label for="street" value="{{ __('Straat') }}"/>
                            <x-input id="street" class="block mt-1 w-full" type="text" wire:model.defer="newUser.street"
                                     required autofocus autocomplete="street"/>
                        </div>
                        <div>
                            <x-label for="house_number" value="{{ __('Huisnummer') }}"/>
                            <x-input id="house_number" class="block mt-1 w-full" type="text"
                                     wire:model.defer="newUser.house_number" required autofocus
                                     autocomplete="house_number"/>
                        </div>
                        <div>
                            <x-label for="postal_code" value="{{ __('Postcode') }}"/>
                            <x-input id="postal_code" class="block mt-1 w-full" type="text"
                                     wire:model.defer="newUser.postal_code" required autofocus
                                     autocomplete="postal_code"/>
                        </div>
                            <div>
                                <x-label for="city" value="{{ __('City') }}"/>
                                <x-input id="city" class="block mt-1 w-full" type="text"
                                         wire:model.defer="newUser.city" required autofocus
                                         autocomplete="city"/>
                            </div>
                        <div>
                            <x-label for="date_of_birth" value="{{ __('Geboortedatum') }}"/>
                            <x-input id="date_of_birth" class="block mt-1 w-full" type="date"
                                     wire:model.defer="newUser.date_of_birth" required autofocus
                                     autocomplete="date_of_birth"/>
                        </div>

                        <div>
                            <x-label for="email" value="{{ __('Email') }}"/>
                            <x-input id="email" class="block mt-1 w-full" type="email" wire:model.defer="newUser.email"
                                     required autocomplete="username"/>
                        </div>

{{--                        <div class="mt-4">--}}
{{--                            <x-label for="password" value="{{ __('Password') }}"/>--}}
{{--                            <x-input id="password" class="block mt-1 w-full" type="password"--}}
{{--                                     wire:model.defer="newUser.password" required autocomplete="new-password"/>--}}
{{--                        </div>--}}

{{--                        <div class="mt-4">--}}
{{--                            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>--}}
{{--                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password"--}}
{{--                                     wire:model.defer="newUser.password_confirmation" required--}}
{{--                                     autocomplete="new-password"/>--}}
{{--                        </div>--}}
                        <div class="mt-5">
                            <x-smod.form.select wire:model.defer="newUser.gender_id" id="gender_id">
                                <option value="%">Geslacht</option>
                                @foreach($genders as $gender)
                                    <option value="{{ $gender->id }}">{{ $gender->name}}</option>
                                @endforeach
                            </x-smod.form.select>
                            <x-smod.form.select wire:model.defer="newUser.role_id" id="role_id">
                                <option value="%">Type gebruiker</option>
                                @foreach($userTypes as $userType)
                                    <option value="{{ $userType->id }}">
                                        {{ $userType->type }}
                                    </option>
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
                        </div>
                        @endif
                    </form>
                </di>
            </x-slot>
            <x-slot name="footer">
                <div class="text-center">
                <x-secondary-button @click="show = false">Annuleer</x-secondary-button>
                @if(is_null($newUser['id']))
                    <x-button
                        wire:click="createNewUser"
                        wire:loading.attr="disabled"
                        class="ml-2 bg-blue-500">Opslaan
                    </x-button>
                @else
                    <x-button
                        color="success"
                        wire:click="updateUser({{ $newUser['id'] }})"
                        wire:loading.attr="disabled"
                        class="ml-2 bg-blue-500">Update gebruiker
                    </x-button>
                @endif
                </div>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
