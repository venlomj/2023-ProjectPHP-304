<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <x-section
        x-data="{ open: false }"
        class="p-0 mb-4 flex flex-col gap-2">
        <div class="p-4 flex justify-between items-start gap-4">
            <div class="relative w-64">
                <x-button class="btn" wire:click="openModal()">
                    Nieuwe maat
                </x-button>
            </div>
            <x-heroicon-o-information-circle
                @click="open = !open"
                class="w-5 text-gray-400 cursor-help outline-0"/>
        </div>
        <x-input-error for="newGenre" class="m-4 -mt-4 w-full"/>
        <div
            x-show="open"
            style="display: none"
            class="text-sky-900 bg-sky-50 border-t p-4">
            <x-list type="ul" class="list-outside mx-4 text-sm">
                <li>
                    Je kan een nieuwe maat toevoegen door te klikken op <b>Nieuwe maat</b>.
                </li>
                <li>
                    Een maat bewerken doe je door op het
                    <x-phosphor-pencil-line-duotone class="w-5 inline-block"/>
                    symbool te drukken en de gegevens aan te passen.
                </li>
                <li>
                    Door te drukken op het
                    <x-phosphor-trash-duotone class="w-5 inline-block"/>
                    symbool kan je de maat verwijderen.
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
                    Maat
                </th>
            </tr>
            </thead>
            @foreach($sizes as $size)
            <tbody>

            <tr wire:key="size_{{ $size->id }}"
                class="border-t border-gray-300 [&>td]:p-2">
                <td x-data="">

                    <div class="flex gap-1 justify-center [&>*]:cursor-pointer [&>*]:outline-0 [&>*]:transition">
                        <x-phosphor-pencil-line-duotone
                            wire:click="setNewSize({{ $size->id }})"
                            class="w-5 text-gray-300 hover:text-green-600"
                        />
                        <x-phosphor-trash-duotone
                            @click="confirm('Are you sure you want to delete this size?') ? $wire.deleteSize({{ $size->id }}) : ''"
                            class="w-5 text-gray-300 hover:text-red-600"
                        />
                    </div>
                </td>
                <td class="text-left cursor-pointer">
                    {{$size->size}}
                </td>
            </tr>

            </tbody>
            @endforeach
        </table>
        <x-dialog-modal id="eventModal" wire:model="openModal">
            <x-slot name="title">
                @if($newSize['id']==null)
                <h2>Nieuwe maat toevoegen</h2>
                @else
                    <h2>Maat bewerken</h2>
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
                <x-input id="size" type="text" step="0.01" wire:model.defer="newSize.size" placeholder="Nieuwe maat">
                </x-input>
            </x-slot>
            <x-slot name="footer">
                <x-button class="mr-4" @click="show = false">
                    Annuleren
                </x-button>
                @if($newSize['id']==null)
                <x-button wire:click="createSize()">
                    Toevoegen
                </x-button>
                @else
                    <x-button wire:click="updateSize({{$newSize['id']}})">
                    Opslaan
                </x-button>
                @endif
            </x-slot>
        </x-dialog-modal>
    </x-section>
</div>
