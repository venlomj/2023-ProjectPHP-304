<div>
    {{-- show preloader while fetching data in the background --}}

    {{-- filter section: artist or title, genre, max price and records per page --}}
    <x-button wire:click='setNewSeason()'>
        nieuw seizoen
    </x-button>

    {{-- master section: cards with paginationlinks --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-8 mt-8">

        @foreach ($seizoen as $season)

            @if($season->active > 0)
                <div
                    wire:key="record-{{ $season->id }}"
                    class="flex bg-white border border-gray-300 bg-green-300 shadow-md rounded-lg overflow-hidden">
                    @else
                        <div
                            wire:key="record-{{ $season->id }}"
                            class="flex bg-white border border-gray-300 bg-red-300 shadow-md rounded-lg overflow-hidden">
                            @endif

                            <div class="flex-1 flex flex-col">
                                <div class="flex-1 p-4">
                                    <p class="text-lg font-bold capitalize font-medium">{{ $season->name }}</p>
                                    <p class="italic pb-2 mt-8">{{ $season->start_date }} - {{ $season->end_date }}</p>
                                </div>
                                <div class="flex justify-between border-t border-gray-300 bg-gray-100 px-4 py-2">
                                    <div>€ {{ $season->amount }}</div>
                                    <div class="w-12 cursor-pointer flex hover:text-black-900">
                                        <div wire:key="season_{{ $season->id }}" class="flex mr-1 ml-auto">
                                            <div x-data="">
                                                <x-phosphor-pencil-line-duotone
                                                    wire:click="setNewSeason({{ $season->id }})"
                                                    class="w-5 text-gray-600 mr-2 ml-auto flex hover:text-green-600"
                                                />
                                            </div>
                                            <div x-data="">
                                                <x-phosphor-trash-duotone
                                                    @click="confirm('Are you sure you want to delete this season?') ? $wire.deleteSeason({{ $season->id }}) : ''"
                                                    class="w-5 text-gray-600 flex mr-2 ml-auto hover:text-red-600"
                                                />
                                            </div>

                                        </div>
                                    </div>

                                    <div class="flex space-x-4">
                                        @if($season->active > 0)
                                            <p class="font-extrabold text-green-700">ACTIEF</p>
                                        @else
                                            <p class="font-extrabold text-red-700">NIET ACTIEF</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach



                        {{--                        <x-dialog-modal--}}
                        {{--                                             wire:model="openModal">--}}
                        {{--                            <x-slot name="title">--}}
                        {{--                                <h2>title</h2>--}}
                        {{--                            </x-slot>--}}
                        {{--                            <x-slot name="content">--}}
                        {{--                                content--}}
                        {{--                            </x-slot>--}}
                        {{--                            <x-slot name="footer">--}}
                        {{--                                <x-secondary-button @click="show = false">Cancel</x-secondary-button>--}}
                        {{--                            </x-slot>--}}
                        {{--                        </x-dialog-modal>--}}


                        <x-dialog-modal id="eventModal" wire:model="openModal">
                            <x-slot name="title">
                                <h2>New Season</h2>
                            </x-slot>
                            <x-slot name="content">
                                @if ($errors->any())
                                    <div type="danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li class="text-red-600">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <x-label for="name" value="Season name"/>
                                <div class="flex flex-row gap-2 mt-2">
                                    <x-input id="name" type="text" placeholder="Season name"
                                             wire:model.defer="newSeason.name"
                                             class="flex-1"/>
                                </div>
                                <div class="flex flex-row gap-4 mt-4">
                                    <div class="flex-1 flex-col gap-2">
                                        <x-label for="amount" value="Price" class="mt-4"/>
                                        <x-input id="amount" type="number" step="1"
                                                 wire:model.defer="newSeason.amount"
                                                 class="mt-1 block w-full"/>
                                        <x-label for="start_date" value="Start Datum" class="mt-4"/>
                                        <x-input id="start_date" type="date"
                                                 wire:model.defer="newSeason.start_date"
                                                 class="mt-1 block w-full"/>
                                        <x-label for="end_date" value="End Datum" class="mt-4"/>
                                        <x-input id="end_date" type="date"
                                                 wire:model.defer="newSeason.end_date"
                                                 class="mt-1 block w-full"/>
                                        <x-label for="active" value="Active?" class="mt-4"/>
                                        <x-input id="active" type="checkbox"
                                                 wire:model.defer="newSeason.active"
                                                 class="mt-1 block"/>

                                    </div>
                                </div>
                            </x-slot>
                            <x-slot name="footer">
                                <x-secondary-button class="mr-4" @click="show = false">Cancel</x-secondary-button>
                                @if($newSeason['id']==null)
                                    <x-button wire:click="createSeason()">
                                        Toevoegen
                                    </x-button>
                                @else
                                    <x-button wire:click="updateSeason({{$newSeason['id']}})">
                                        Opslaan
                                    </x-button>
                                @endif

                            </x-slot>
                        </x-dialog-modal>


                </div>

                {{-- Detail section --}}
    </div>
</div>

