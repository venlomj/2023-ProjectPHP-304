@guest
    <p class="text-center text-xl">Je moet ingelogd zijn als ouder om je zoon/dochter in te schrijven in onze club.</p>
@endguest
@auth
@if((in_array(auth()->user()->role->id, [1,2,3,4,5])))
    <div>
        <x.section
            class="p-0 mb-4 flex flex-col gap-2">
            <x-input-error for="newRegistration" class="m-4 -mt-4 w-full"/>
            <div class="md:grid grid-cols-2 gap-2">
                <div class="grid mb-2">
                    <x-label for="first_name" value="Voornaam"/>
                    <x-input id="first_name" type="text" step="0.01" wire:model.defer="newRegistration.first_name" placeholder="Voornaam">
                    </x-input>
                </div>
                <div class="grid mb-2">
                    <x-label for="last_name" value="Achternaam"/>
                    <x-input id="last_name" type="text" step="0.01" wire:model.defer="newRegistration.last_name" placeholder="Achternaam">
                    </x-input>
                </div>
            </div>
            <div class="md:grid grid-cols-2 gap-2">
                <div class="grid mb-2">
                    <x-label for="phone_number" value="Telefoonnummer"/>
                    <x-input id="phone_number" type="text" step="0.01" wire:model.defer="newRegistration.phone_number" placeholder="Telefoonnummer">
                    </x-input>
                </div>
                <div class="grid mb-2">
                    <x-label for="email" value="Email"/>
                    <x-input id="email" type="text" step="0.01" wire:model.defer="newRegistration.email" placeholder="Email">
                    </x-input>
                </div>
            </div>
            <div class="md:grid grid-cols-2 gap-2">
                <div class="grid mb-2">
                    <x-label for="street" value="Straat"/>
                    <x-input id="street" type="text" step="0.01" wire:model.defer="newRegistration.street" placeholder="Straat">
                    </x-input>
                </div>
                <div class="grid mb-2">
                    <x-label for="house_number" value="Huisnummer"/>
                    <x-input id="house_number" type="text" step="0.01" wire:model.defer="newRegistration.house_number" placeholder="Huisnummer">
                    </x-input>
                </div>
            </div>
            <div class="md:grid grid-cols-2 gap-2">
                <div class="grid mb-2">
                    <x-label for="city" value="Stad/dorp"/>
                    <x-input id="city" type="text" step="0.01" wire:model.defer="newRegistration.city" placeholder="Stad/dorp">
                    </x-input>
                </div>
                <div class="grid mb-2">
                    <x-label for="postal_code" value="Postcode"/>
                    <x-input id="postal_code" type="text" step="0.01" wire:model.defer="newRegistration.postal_code" placeholder="Postcode">
                    </x-input>
                </div>
            </div>
            <div class="md:grid grid-cols-2 gap-2">
                <div class="grid mb-2">
                    <x-label for="national_insurance_number" value="Rijksregisternummer"/>
                    <x-input id="national_insurance_number" type="text" step="0.01" wire:model.defer="newRegistration.national_insurance_number" placeholder="Rijksregisternummer">
                    </x-input>
                </div>
                <div class="grid mb-2">
                    <x-label for="date_of_birth" value="Geboortedatum"/>
                    <x-input id="date_of_birth" type="date" step="0.01" wire:model.defer="newRegistration.date_of_birth" placeholder="Geboortedatum">
                    </x-input>
                </div>
            </div>
                <div class="grid mb-2">
                    <x-label for="comment" value="Opmerking"/>
                    <textarea class="h-24 border-gray-300 rounded" id="comment" type="text" step="0.01" wire:model.defer="newRegistration.comment" placeholder="Opmerking">
                    </textarea>
                </div>
            <div class="md:grid grid-cols-3 gap-2">
                <div class="">
                    <label for="payment_method_id" class="block text-sm font-medium leading-6 text-gray-900">Betaalmethode</label>
                    <select id="payment_method_id" name="payment_method_id" class="rounded border-gray-300">
                        <option>Kies een betaalmethode</option>
                        @foreach($payment_methods as $payment_method)
                            <option value="{{$payment_method['id']}}">{{$payment_method['method']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <label for="payment_method_id" class="block text-sm font-medium leading-6 text-gray-900">Geslacht</label>
                    <select id="payment_method_id" name="payment_method_id" class="rounded border-gray-300">
                        <option>Kies een geslacht</option>
                        @foreach($genders as $gender)
                            <option value="{{$gender['id']}}">{{$gender['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-right font-bold">
                    <label for="prijs" class="block text-sm font-medium leading-6 text-gray-900">Prijs:</label>
                    <p class="grid">€{{$season->amount}}</p>
                </div>
            </div>


        </x.section>
        <div class="text-right">
            <x-button  wire:click="createRegistration()">
                Volgende
            </x-button>
        </div>
    </div>

@else
    <p class="text-center text-xl">Vraag één van je ouders om je in te schrijven.</p>
@endif
@endauth
