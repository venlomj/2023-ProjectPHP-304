<div>
    {{--     show preloader while fetching data in the background --}}
    <div class="fixed top-8 left-1/2 -translate-x-1/2 z-50"
         wire:loading>
        {{--<x-smod.preloader class="px-1">
            {{ $loading }}
        </x-smod.preloader>--}}
    </div>

    <x-smod.section class="mb-4 flex gap-2">
        <div class="flex-1">
            <x-input id="name"
                     wire:model="name"
                     type="text"
                     placeholder="Aankoop"
                     class="w-full shadow-md placeholder-gray-300"/>
        </div>
        <div class="flex-1">
            <x-smod.form.switch id="notApproved"
                                wire:model="notApproved"
                                text-off="Niet goedgekeurd"
                                color-off="bg-gray-100 before:line-through"
                                text-on="goedgekeurd"
                                color-on="text-white bg-lime-600"
                                class="w-full h-11"/>
        </div>
        <x-button wire:click="setNewExpense()">
            Onkosten aanbrengen
        </x-button>
    </x-smod.section>



    <x-smod.section>
        <div class="my-4">{{ $expenses->links() }}</div>
        <table class="text-center w-full border border-gray-300">
            <colgroup>
                <col class="w-14">
                <col class="w-max">
                <col class="w-18">
                <col class="w-max">
                <col class="w-24">
            </colgroup>
            <thead>
            <tr class="bg-gray-100 text-gray-700 [&>th]:p-2">
                <th>#</th>
                <th class="text-left">Aankoop</th>
                <th>Prijs</th>
                <th class="text-left">Omschrijving</th>
                <th>
                    <x-smod.form.select id="perPage"
                                       class="block mt-1 w-full">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </x-smod.form.select>
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($expenses as $expense)
            <tr
                wire:key="expense_{{ $expense->id }}"
                class="border-t border-gray-300">
{{--                de "$loop->iteration" nummert alle expenses; het is geen id--}}
                <td>{{ $loop->iteration  }}</td>
                <td class="text-left">{{ $expense->name }}</td>
                <td >{{ $expense->price }} €</td>
                <td class="text-left">{{ $expense->comment }}</td>
                <td>
                    <div class="border border-gray-300 rounded-md overflow-hidden m-2 grid grid-cols-2 h-10"
                         x-data="">
                        <button
                            wire:click="setNewExpense({{ $expense->id }})"
                            class="text-gray-400 hover:text-sky-100 hover:bg-sky-500 transition border-r border-gray-300">
                            <x-phosphor-pencil-line-duotone class="inline-block w-5 h-5"/>
                        </button>
                        <button
                            class="text-gray-400 hover:text-red-100 hover:bg-red-500 transition">
                            <x-phosphor-trash-duotone
                                class="inline-block w-5 h-5"
                                @click="$dispatch('swal:confirm', {
                            title: 'Verwijder {{ $expense->name }}?',
                            cancelButtonText: 'NEEN!',
                            confirmButtonText: 'Ja, verwijder onkost',
                            next: {
                                event: 'delete-expense',
                                params: {
                                    id: {{ $expense->id }}
                                }
                            }
                        });"/>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="6" class="border-t border-gray-300 p-4 text-center text-gray-500">
                        <div class="font-bold italic text-sky-800">Geen onkosten gevonden</div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="my-4">{{ $expenses->links() }}</div>
    </x-smod.section>
    <x-dialog-modal id="expenseModal" wire:model="showModal">
        <div class="max-w-xl mx-auto bg-white rounded-md shadow-md p-6 shadow-2xl rounded-xl">
            <x-slot name="title">
                <h2 class="text-2xl font-bold mb-4">{{ is_null($newExpense['id']) ? 'Nieuwe onkosten' : 'Onkosten bijwerken' }}</h2>
            </x-slot>
            <hr class="my-4">
            <x-slot name="content">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    @if ($errors->any())
                        <x-smod.alert type="danger">
                            <x-smod.list>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </x-smod.list>
                        </x-smod.alert>
                    @endif
                    <div>
                        <label for="name" class="font-bold">Aankoop:</label>
                        <x-input id="name" type="text" class="w-full border-gray-300 border rounded-md"
                                 placeholder="Naam onkost"
                                 wire:model.defer="newExpense.name" />
                    </div>
                    <div>
                        <label for="price" class="font-bold">Prijs:</label>
                        <x-input id="price" type="number"
                                 min="0" class="w-full border-gray-300 border rounded-md"
                                 placeholder="0.00"
                                 wire:model.defer="newExpense.price" />
                    </div>
                    <div>
                        <label for="approved" class="font-bold inline-flex items-center">
                            <input id="approved" type="checkbox" class="form-checkbox border-gray-300"
                                   wire:model.defer="newExpense.approved" />
                            <span class="ml-2">Goedkeuring</span>
                        </label>
                    </div>
                    <div>
                        <label for="rejection" class="font-bold">Reden voor afwijzing:</label>
                        <x-input id="rejection" type="text" class="w-full border-gray-300 border rounded-md"
                                 placeholder="Reden voor afwijzing"
                                 wire:model.defer="newExpense.rejection" />
                    </div>
                    <div>
                        <label for="input_date" class="font-bold">Invoerdatum:</label>
                        <x-input id="input_date" type="date" class="w-full border-gray-300 border rounded-md"
                                 placeholder="Invoerdatum"
                                 wire:model.defer="newExpense.input_date"
                                 value="{{ now()->toDateString() }}" readonly />
                    </div>
                    <div>
                        <label for="payment_date" class="font-bold">Betalingsdatum:</label>
                        <x-input id="payment_date" type="date" class="w-full border-gray-300 border rounded-md"
                                 placeholder="Betalingsdatum"
                                 wire:model.defer="newExpense.payment_date" />
                    </div>
                </div>

                <div class="mb-4">
                    <label for="comment" class="font-bold">Opmerking:</label>
                    <x-smod.form.textarea id="comment"
                                          class="w-full border-gray-300 border rounded-md py-2 px-4"
                                          placeholder="Textarea"
                                          wire:model.defer="newExpense.comment" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="flex justify-center space-x-4">
                    <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" @click="show = false">Annuleer</button>
                    @if(is_null($newExpense['id']))
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                                wire:click="addExpense()"
                                wire:loading.attr="disabled">Opslaan</button>
                    @else
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                                wire:click="updateExpense({{ $newExpense['id'] }})"
                                wire:loading.attr="disabled">Bijwerken</button>
                    @endif
                </div>
            </x-slot>
        </div>
    </x-dialog-modal>




</div>
