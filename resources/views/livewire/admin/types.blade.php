<div>
    <x.section>
        <x-button wire:click='setNewType()'>
            nieuw type
        </x-button>

        <table class="text-center w-full border mt-10 border-gray-300">
            <colgroup>
                <col class="w-8">
                <col class="w-max">
                <col class="w-max">
            </colgroup>
            <thead>
            <tr class="bg-gray-100 text- text-gray-700 [&>th]:p-2 cursor-pointer">
                <th></th>
                <th>
                    Foto
                </th>
                <th>
                    Type
                </th>
                <th>
                    Prijs
                </th>
                <th>
                    Active
                </th>
            </tr>
            </thead>
            @foreach($types as $type)
                <tbody>

                <tr wire:key="type_{{ $type->id }}"
                    class="border-t border-gray-300 [&>td]:p-2">
                    <td x-data="">

                        <div class="flex gap-1 justify-center [&>*]:cursor-pointer [&>*]:outline-0 [&>*]:transition">
                            <x-phosphor-pencil-line-duotone
                                wire:click="setNewType({{ $type->id }})"
                                class="w-5 text-gray-300 hover:text-green-600"
                            />
                            <x-phosphor-trash-duotone
                                @click="confirm('Are you sure you want to delete this type?') ? $wire.deleteType({{ $type->id }}) : ''"
                                class="w-5 text-gray-300 hover:text-red-600"
                            />
                        </div>
                    </td>
                    <td>
                        <img src="{{ $type->cover }}"
                             alt="{{ $type->type }}"
                             class="my-2 border ml-auto mr-auto max-w-[150px] object-cover">

                    </td>
                    <td class="text-center cursor-pointer">
                        {{ $type->type}}
                    </td>
                    <td class="text-center cursor-pointer">
                        @foreach($prices as $price)
                            @if($price['id'] == $type['id'])
                                {{ $price->price}}
                            @endif
                        @endforeach
                    </td>
                    <td class="text-center cursor-pointer">
                        {{ $type->active}}
                    </td>
                </tr>

                </tbody>
            @endforeach
        </table>
        <x-dialog-modal id="eventModal" wire:model="openModal">
            <x-slot name="title">
                @if($newType['id']== null)
                    <h2>Nieuwe Type toevoegen</h2>
                @else
                    <h2>Type bewerken</h2>
                @endif
            </x-slot>
            <x-slot name="content">
                <div class="flex inline-flex text-base mb-5">
                    <x-input id="type" type="text" step="0.01" wire:model.defer="newType.type" placeholder="Nieuwe Type">
                    </x-input>
                </div>
                <div class="flex inline-flex text-base ml-12 mb-5">
                    <x-input id="price" type="number" step="0.5" wire:model.defer="newType.price" placeholder="Nieuwe Prijs">
                    </x-input>
                </div>
                {{--                isset($newType) ? $newType->temporaryUrl()--}}
                <div class="flex inline-flex text-base ml-5">
                    <input type="file" wire:model="newType.cover">
{{--                    <img wire:model.defer="newType.cover" src="{{ $newType['cover'] }}"--}}
{{--                         alt="{{ $newType['type'] }}"--}}
{{--                         class="my-2 border ml-auto mr-auto max-w-[150px] objct-cover">--}}
                </div>
                <div>
                    @if($newType['id']== null)
                        <x-label class="mt-4" for="active" value="Actief verplicht in te vullen!"/>
                    @else
                        <x-label class="mt-4" for="active" value="Actief"/>
                    @endif
                    <x-input id="active" type="checkbox" class="mt-4" step="1"  wire:model.defer="newType.active" placeholder="Actief">
                    </x-input>
                </div>

            </x-slot>
            <x-slot name="footer">
                <x-secondary-button class="mr-4" @click="show = false">
                    Annuleren
                </x-secondary-button>
                @if($newType['id']==null)
                    <x-button wire:click="createType()"
                              wire:target="newType.cover"
                              wire:loading.attr="disabled">
                        Toevoegen
                    </x-button>
                @else
                    <x-button wire:click="updateType({{ $newType['id'] }})"
                              wire:target="newType.cover"
                              wire:loading.attr="disabled">
                        Opslaan
                    </x-button>
                @endif
            </x-slot>
        </x-dialog-modal>
    </x.section>
</div>
