<div class="flex" x-data="{
    showDetailTable: @entangle('showDetailTable')
}">
    <div class="w-1/2">
        <div class="flex justify-between space-x-4 pb-2 border-b border-gray-300 mb-2">
            <h3 class="font-semibold">
                Verdeellijsten <br/>
            </h3>
        </div>
        <table class="text-center w-auto border border-gray-300">
            <colgroup>
                <col class="w-25">
                <col class="w-25">
                <col class="w-25">
            </colgroup>
            <thead>
            <tr class="bg-gray-100 text-gray-700 [&>th]:p-2 cursor-pointer">
                <th wire:click="resort('max_age')">
                    <span data-tippy-content="Order by group">Groep</span>
                    <x-heroicon-s-chevron-up
                        class="w-5 text-slate-400
                 {{$orderAsc ?: 'rotate-180'}}
                 {{$orderBy === 'max_age' ? 'inline-block' : 'hidden'}}
             "/>
                </th>
                <th>
                <span>
                    Aantal bestellingen
                </span>
                </th>
                <th class="text-left">
                    <span>Aantal Artikels</span>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($groups as $group)
                <tr class="border-t border-gray-300 [&>td]:p-2" x-data="{ group_id: {{ $group->id }}, members: []}">
                    <td class="cursor-pointer" wire:click="showGroups({{ $group->id }})">U {{ $group->max_age }}</td>
                    <td>{{ $group->number_orders > 0 ? $group->number_orders : 'Geen bestelling'}}</td>
                    <td
                        class="text-left">
                        {{ $group->number_products > 0 ? $group->number_products : 'Geen artikels' }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="w-1/2">
        @isset($selectedGroup->member)
            <div class="flex justify-between space-x-4 pb-2 border-b border-gray-300 mb-2">
                <h3 class="font-semibold">
                    Verdeellijst U {{ $selectedGroup->group->max_age ?? 'Verdeellijst per groep' }}<br/>
                </h3>
            </div>
        <table class="text-center w-auto border border-gray-300 " x-show="showDetailTable">
            <thead>
            <tr>
                <th>Naam</th>
                <th>Totaal</th>
                <th>Betaald</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $selectedGroup->member->name }}</td>
                <td></td>
                <td>John Doe</td>
            </tr>
            </tbody>
        </table>
        @endisset
    </div>
</div>
