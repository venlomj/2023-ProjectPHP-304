<div>
    <x-section
        x-data="{ open: false }"
        class="p-0 mb-4 flex flex-col gap-2">
        <div class="p-4 flex justify-between items-start gap-4">
            <div class="relative w-64">
                <x-button class="btn" wire:click="openModal()">
                    Nieuw veld
                </x-button>
            </div>
            <div class="relative w-64">
                <x-switch class="btn"
                          id="noStock"
                          wire:model="showactive"
                          text-off="Actief filter"
                          color-off="bg-gray-100"
                          text-on="Actief"
                          color-on="text-white bg-lime-600"
                          class="w-20 h-11">
                    Actief
                </x-switch>
            </div>
            <x-heroicon-o-information-circle
                @click="open = !open"
                class="w-5 text-gray-400 cursor-help outline-0"/>
        </div>
        <x-input-error for="newField" class="m-4 -mt-4 w-full"/>
        <div
            x-show="open"
            style="display: none"
            class="text-sky-900 bg-sky-50 border-t p-4">
            <x-list type="ul" class="list-outside mx-4 text-sm">
                <li>
                    Je kan een nieuw veld toevoegen door te klikken op <b>Nieuw veld</b>.
                </li>
                <li>
                    Een veld bewerken doe je door op het
                    <x-phosphor-pencil-line-duotone class="w-5 inline-block"/>
                    symbool te drukken en de gegevens aan te passen.
                </li>
                <li>
                    Door te drukken op het
                    <x-phosphor-trash-duotone class="w-5 inline-block"/>
                    symbool kan je het veld verwijderen.
                </li>
                <li>
                    Door te klikken op <b>Actief filter</b> kun je enkel de actieve velden tonen.
                </li>
                <li>
                    Om het help scherm te sluiten moet je klikken op het
                    <x-heroicon-o-information-circle class="w-5 inline-block"/>
                    symbool.
                </li>
            </x-list>
        </div>
    </x-section>
    <x-section>
        <table class="text-center w-full border border-gray-300">
            <colgroup>
                <col class="w-8">
                <col class="w-max">
                <col class="w-max">
            </colgroup>
            <thead>
            <tr class="bg-gray-100 text-left text-gray-700 [&>th]:p-2 cursor-pointer">
                <th></th>
                <th class="text-left">
                    Naam
                </th>
                <th>
                    Straat
                </th>
                <th>
                    Huisnummer
                </th>
                <th>
                    Stad/Dorp
                </th>
                <th>
                    Postcode
                </th>
                <th>
                    Actief
                </th>
            </tr>
            </thead>
            @foreach($fields as $field)
                <tbody>

                <tr wire:key="field_{{ $field->id }}"
                    class="border-t border-gray-300 [&>td]:p-2">
                    <td x-data="">

                        <div class="flex gap-1 justify-center [&>*]:cursor-pointer [&>*]:outline-0 [&>*]:transition">
                            <x-phosphor-pencil-line-duotone
                                wire:click="setNewField({{ $field->id }})"
                                class="w-5 text-gray-300 hover:text-green-600"
                            />
                            <x-phosphor-trash-duotone
                                @click="confirm('Are you sure you want to delete this field?') ? $wire.deleteField({{ $field->id }}) : ''"
                                class="w-5 text-gray-300 hover:text-red-600"
                            />
                        </div>
                    </td>
                    <td class="text-left">
                        {{$field->name}}
                    </td>
                    <td class="text-left">
                        {{$field->street}}
                    </td>
                    <td class="text-left">
                        {{$field->house_number}}
                    </td>
                    <td class="text-left">
                        {{$field->city}}
                    </td>
                    <td class="text-left">
                        {{$field->postal_code}}
                    </td>
                    <td class="text-left">
                        @if($field->active == false) <p>Nee</p> @else <p>Ja</p> @endif
                    </td>
                </tr>

                </tbody>
            @endforeach
        </table>
        <x-dialog-modal id="eventModal" wire:model="openModal">
            <x-slot name="title">
                @if($newField['id']==null)
                    <h2>Nieuw veld toevoegen</h2>
                @else
                    <h2>Veld bewerken</h2>
                @endif
            </x-slot>
            <x-slot name="content">
                @if ($errors->any())
                    <x.alert type="danger">
                        <x.list>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </x.list>
                    </x.alert>
                @endif
                <div class="grid mb-2">
                    <x-label for="name" value="Naam"/>
                    <x-input id="name" type="text" step="0.01" wire:model.defer="newField.name" placeholder="Naam">
                    </x-input>
                </div>
                    <div class="grid grid-cols-2 gap-2">
                    <div class="grid">
                        <x-label for="street" value="Straat"/>
                        <x-input id="street" type="text" step="0.01" wire:model.defer="newField.street" placeholder="Straat">
                        </x-input>
                    </div>
                    <div class="grid">
                        <x-label for="house_number" value="Huisnummer"/>
                        <x-input id="house_number" type="text" step="0.01" wire:model.defer="newField.house_number" placeholder="Huisnummer">
                        </x-input>
                    </div>
                    <div class="grid">
                        <x-label for="city" value="Stad/Dorp"/>
                        <x-input id="city" type="text" step="0.01" wire:model.defer="newField.city" placeholder="Stad/Dorp">
                        </x-input>
                    </div>
                    <div class="grid">
                        <x-label for="postal_code" value="Postcode"/>
                        <x-input id="postal_code" type="text" step="0.01" wire:model.defer="newField.postal_code" placeholder="Postcode">
                        </x-input>
                    </div>
                </div>
                    <div class="mt-2">
                        <x-label for="active" value="Actief"/>
                        <x-input id="active" type="checkbox" step="1" wire:model.defer="newField.active" placeholder="Actief">
                        </x-input>
                    </div>

            </x-slot>
            <x-slot name="footer">
                <x-button class="mr-4" @click="show = false">
                    Annuleren
                </x-button>
                @if($newField['id']==null)
                    <x-button wire:click="createField()">
                        Toevoegen
                    </x-button>
                @else
                    <x-button wire:click="updateField({{$newField['id']}})">
                        Opslaan
                    </x-button>
                @endif
            </x-slot>
        </x-dialog-modal>
    </x-section>
</div>
