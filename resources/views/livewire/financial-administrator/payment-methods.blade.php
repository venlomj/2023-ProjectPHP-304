<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <x-section
        class="p-0 mb-4 flex flex-col gap-2">
        <div class="p-4 flex justify-between items-start gap-4">
            <div class="relative w-64">
                <x-button class="btn" wire:click="openModal()">
                    Nieuwe betaalmethode
                </x-button>
            </div>
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
                <th class="text-center">
                    Betalingsmethode
                </th>
                <th class="text-center">
                    Actief
                </th>
            </tr>
            </thead>
            @foreach($methods as $method)
                <tbody>

                <tr wire:key="paymentMethod_{{ $method->id }}"
                    class="border-t border-gray-300 [&>td]:p-2">
                    <td x-data="">

                        <div class="flex gap-1 justify-center [&>*]:cursor-pointer [&>*]:outline-0 [&>*]:transition">
                            <x-phosphor-pencil-line-duotone
                                wire:click="setNewPaymentMethod({{ $method->id }})"
                                class="w-5 text-gray-300 hover:text-green-600"
                            />
                            <x-phosphor-trash-duotone
                                @click="confirm('Are you sure you want to delete this method?') ? $wire.deletePaymentMethod({{ $method->id }}) : ''"
                                class="w-5 text-gray-300 hover:text-red-600"
                            />
                        </div>
                    </td>
                    <td class="text-center cursor-pointer">
                        {{$method->method}}
                    </td>
                    <td class="text-center cursor-pointer">
                        @if($method['active'])
                            <h2 class="text-green-500">Actief</h2>
                        @else
                            <h2 class="text-red-500">Niet Actief</h2>
                        @endif
                    </td>
                </tr>

                </tbody>
            @endforeach
        </table>
        <x-dialog-modal id="eventModal" wire:model="openModal">
            <x-slot name="title">
                @if($newPaymentMethod['id']==null)
                    <h2>Nieuwe betaalmethode toevoegen</h2>
                @else
                    <h2>Betaalmethode bewerken</h2>
                @endif
            </x-slot>
            <x-slot name="content">
                <x-input id="method" type="text" wire:model.defer="newPaymentMethod.method" placeholder="Nieuwe betaalmethode">
                </x-input>
                <div>
                    <x-label class="mt-4" for="active" value="Actief"/>
                    <x-input id="active" type="checkbox" class="mt-4" step="1"  wire:model.defer="newPaymentMethod.active" placeholder="Actief">
                    </x-input>
                </div>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </x-slot>
            <x-slot name="footer">
                <x-button class="mr-4" @click="show = false">
                    Annuleren
                </x-button>
                @if($newPaymentMethod['id']==null)
                    <x-button wire:click="createPaymentMethod()">
                        Toevoegen
                    </x-button>
                @else
                    <x-button wire:click="updatePaymentMethod({{$newPaymentMethod['id']}})">
                        Opslaan
                    </x-button>
                @endif
            </x-slot>
        </x-dialog-modal>
    </x-section>
</div>
