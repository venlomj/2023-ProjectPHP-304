<div>
{{--     show preloader while fetching data in the background --}}
    <div class="fixed top-8 left-1/2 -translate-x-1/2 z-50"
         wire:loading>
        {{--<x-smod.preloader class="px-1">
            {{ $loading }}
        </x-smod.preloader>--}}
    </div>
    <x.section>
        <div class="my-4">{{ $groups->links() }}</div>
{{--    <x-smod.form.select id="group" wire:model="group" class="block">--}}
{{--        <div class="flex">--}}
{{--            <label for="group">Groep:</label>--}}
{{--            <option value="%">Selecteer een groep</option>--}}
{{--            @foreach($allGroups as $group)--}}
{{--                <option value="{{ $group->id}}">--}}
{{--                    {{ $group->name }}--}}
{{--                </option>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </x-smod.form.select>--}}

        <div class="flex items-center gap-4">
            <label for="group" class="mr-2">Groep:</label>
            <x-smod.form.select id="group" name="group">
                <option value="%">Selecteer een groep</option>
                @foreach($allGroups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </x-smod.form.select>
        </div>

        <table class="text-left w-full border mt-10 border-gray-300">
            <thead>
            <tr class="bg-gray-100 text- text-gray-700 [&>th]:p-2 cursor-pointer">
                <th class="">
                    Naam
                </th>
                <th>
                    E-mailadres
                </th>
                <th>
                    Telefoonnummer
                </th>
            </tr>
            </thead>
            @foreach($groups as $group)
                <tbody>

                <tr wire:key="group_{{ $group->id }}"
                    class="border-t border-gray-300 [&>td]:p-2">

                    <td>
                        {{ $group->group->name}}
                    </td>
                    <td>
                        {{ $group->member->email }}
                    </td>
                    <td>
                        {{ $group->member->phone_number }}
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
        <div class="my-4">{{ $groups->links() }}</div>
    </x.section>
</div>
