<div>
    <x-section
        x-data="{ open: false }"
        class="p-0 mb-4 flex flex-col gap-2">
        <div class="p-4 flex justify-between items-start gap-4">
            <div class="relative w-64">
                <x-button class="btn" wire:click="openModal()">
                    Nieuw trainersloon
                </x-button>
            </div>
            <x-heroicon-o-information-circle
                @click="open = !open"
                class="w-5 text-gray-400 cursor-help outline-0"/>
        </div>
        <x-input-error for="newHourlyWage" class="m-4 -mt-4 w-full"/>
        <div
            x-show="open"
            style="display: none"
            class="text-sky-900 bg-sky-50 border-t p-4">
            <x-list type="ul" class="list-outside mx-4 text-sm">
                <li>
                    Je kan een nieuw loon toevoegen door te klikken op <b>Nieuw trainersloon</b>.
                </li>
                <li>
                    Een loon bewerken doe je door op het
                    <x-phosphor-pencil-line-duotone class="w-5 inline-block"/>
                    symbool te drukken en de gegevens aan te passen. Dit kan enkel wanneer het uurloon nog niet geldig is.
                </li>
                <li>
                    Door te drukken op het
                    <x-phosphor-trash-duotone class="w-5 inline-block"/>
                    symbool kan je het loon verwijderen.
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
                    Trainer
                </th>
                <th>
                    Uurloon
                </th>
                <th>
                    Vanaf
                </th>
            </tr>
            </thead>
            @foreach($hourlywages as $hourlywage)
                <tbody>
                <tr wire:key="$hourlywage_{{ $hourlywage->id }}"
                    class="border-t border-gray-300 [&>td]:p-2">
                    <td x-data="">

                        <div class="flex gap-1 justify-center [&>*]:cursor-pointer [&>*]:outline-0 [&>*]:transition">
                            @if($hourlywage->wage_from >= $dt)
                                <x-phosphor-pencil-line-duotone
                                    wire:click="setNewHourlyWage({{ $hourlywage->id }})"
                                    class="w-5 text-gray-300 hover:text-green-600"
                                />
                            @else
                                <x-phosphor-pencil-line-duotone style="visibility: hidden" class="w-5"/>
                            @endif
                            <x-phosphor-trash-duotone
                                @click="confirm('Are you sure you want to delete this field?') ? $wire.deleteHourlyWage({{ $hourlywage->id }}) : ''"
                                class="w-5 text-gray-300 hover:text-red-600 text-right"
                            />
                        </div>
                    </td>
                    <td class="text-left">
                        {{$hourlywage->user['first_name']}}
                        {{$hourlywage->user['last_name']}}
                    </td>
                    <td class="text-left">
                        €{{$hourlywage->wage}}
                    </td>
                    <td class="text-left">
                        {{\Carbon\Carbon::parse($hourlywage->wage_from)->formatLocalized('%d/%m/%Y')}}
                    </td>
                </tr>

                </tbody>
            @endforeach
        </table>
        <x-dialog-modal id="eventModal" wire:model="openModal">
            <x-slot name="title">
                @if($newHourlyWage['id']==null)
                    <h2>Nieuwe loon toevoegen</h2>
                @else
                    <h2>Loon bewerken</h2>
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
                <div class="grid">
                    <x-label for="user_id" value="Trainer"/>
                    <select class="mb-2" id="user_id" step="0.01" wire:model.defer="newHourlyWage.user_id" placeholder="Trainer">
                        <option>Kies een trainer</option>
                        @foreach($users as $user)
                            <option value="{{$user['id']}}">{{$user['first_name']}} {{$user['last_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="grid">
                        <x-label for="wage" value="Loon (€)"/>
                        <x-input id="wage" type="text" step="0.01" wire:model.defer="newHourlyWage.wage" placeholder="Loon">
                        </x-input>
                    </div>
                    <div class="grid">
                        <x-label for="wage_from" value="Vanaf"/>
                        <x-input id="wage_from" type="date" step="0.01" wire:model.defer="newHourlyWage.wage_from" placeholder="Datum">
                        </x-input>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button class="mr-4" @click="show = false">
                    Annuleren
                </x-button>
                @if($newHourlyWage['id']==null)
                    <x-button wire:click="createHourlyWage()">
                        Toevoegen
                    </x-button>
                @else
                    <x-button wire:click="updateHourlyWage({{$newHourlyWage['id']}})">
                        Opslaan
                    </x-button>
                @endif
            </x-slot>
        </x-dialog-modal>
    </x-section>
</div>
