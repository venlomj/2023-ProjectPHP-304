@guest
    <p class="text-center text-xl">Je moet ingelogd zijn als ouder om kleding te kunnen bestellen.</p>
@endguest
@auth
    @if((in_array(auth()->user()->role->id, [1,2,3,4,5])))
<div>
    {{-- master section: cards with paginationlinks --}}
    <div class="grid grid-cols-3 ml-auto mr-auto mt-8 inline-flex items-center">

        @foreach ($types as $type1)
            <a wire:click="selectClothes">
                <img src="{{ $type1->cover }}"
                     alt="{{ $type1->type }}"
                     class="my-2 border ml-auto mr-auto max-w-[250px] object-cover">
            </a>

        @endforeach

    </div>

    <x-dialog-modal id="eventModal" wire:model="openModal">
        <x-slot name="title">
                <h2>Nieuw product toevoegen</h2>
        </x-slot>
        <x-slot name="content">
            @foreach ($types as $type1)
                <a wire:click="selectClothes">
                    <img src="{{ $type1->cover }}"
                         alt="{{ $type1->type }}"
                         class="my-2 border ml-auto mr-auto max-w-[150px] object-cover">
                </a>

                <div class="grid">
                    <x-label for="user_id" value="Sizes"/>
                    <select class="mb-2" id="user_id" step="0.01" wire:model.defer="newProduct.id" placeholder="Sizes">
                        <option>Kies een Maat</option>
                        @foreach($sizes as $size)
                            <option value="{{$size['id']}}">{{$size['size']}}</option>
                        @endforeach
                    </select>
                    <x-input id="order" type="number" step="1" wire:model.defer="newProduct.quantity" placeholder="Hoeveelheid">
                    </x-input>
                </div>

            @endforeach
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button class="mr-4" @click="show = false">
                Annuleren
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
    @else
        <p class="text-center text-xl">Vraag één van je ouders kleding te bestellen.</p>
    @endif
@endauth

