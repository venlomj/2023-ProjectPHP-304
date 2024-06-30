<x-hockeyclub-layout>
    <x-slot name="description">dashboard</x-slot>
    <x-slot name="title">{{ auth()->user()->full_name }}'s Dashboard</x-slot>

    <x-smod.section>
        <x-welcome />
    </x-smod.section>
</x-hockeyclub-layout>
