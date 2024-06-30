<nav class="container mx-auto p-4 flex justify-between">
    {{-- left navigation--}}
    <div class="flex items-center space-x-2">
        {{-- Logo --}}
        {{--<a href="{{ route('home') }}">
            <x-tmk.logo class="w-8 h-8"/>
        </a>--}}
        <a class="hidden sm:block font-medium text-lg" href="/">
            SMO-D
        </a>
        <x-nav-link href="{{ route('calenders') }}" :active="request()->routeIs('calenders')">
            Kalender
        </x-nav-link>
        <x-nav-link href="{{ route('registrations') }}" :active="request()->routeIs('registrations')">
            Inschrijven
        </x-nav-link>
        <x-nav-link href="{{ route('products') }}" :active="request()->routeIs('products')">
            Kledij
        </x-nav-link>
        <x-nav-link href="{{ route('help') }}" :active="request()->routeIs('help')">
            Help
        </x-nav-link>
        <x-nav-link href="{{ route('faq') }}" :active="request()->routeIs('faq')">
            FAQ
        </x-nav-link>


    </div>

    {{-- right navigation --}}

    <div class="relative flex items-center space-x-2">
        @guest
            <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                Login
            </x-nav-link>
            <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                Registreer
            </x-nav-link>
        @endguest

        <x-nav-link href="#" :active="request()->routeIs('#')">
            {{--<x-fas-shopping-basket class="w-4 h-4"/>--}}
        </x-nav-link>
        {{-- dropdown navigation--}}
            @auth
                <x-dropdown align="right" width="48">
                    {{-- avatar --}}
                    <x-slot name="trigger">
                        <img class="rounded-full h-8 w-8 cursor-pointer"
                             src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->full_name) }}"
                             alt="{{ auth()->user()->full_name }}">
                    </x-slot>
                    <x-slot name="content">
                        {{-- all users --}}
                        <div class="block px-4 py-2 text-xs text-gray-400">{{ auth()->user()->full_name }}</div>
                        <x-dropdown-link href="{{ route('dashboard') }}">Dashboard</x-dropdown-link>
                        <x-dropdown-link href="{{ route('profile.show') }}">Profiel bijwerken</x-dropdown-link>
                        <div class="border-t border-gray-100"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">Afmelden</button>
                        </form>
                        {{-- admins only --}}
                        @if(auth()->user()->role->type == 'admin')
                        <div class="block px-4 py-2 text-xs text-gray-400">Admin</div>
                        <x-dropdown-link href="{{ route('admin.users') }}">Gebruikers beheren</x-dropdown-link>
                        <x-dropdown-link href="{{ route('admin.sizes') }}">Maten beheren</x-dropdown-link>
                            <x-dropdown-link href="{{ route('admin.types') }}">Types beheren</x-dropdown-link>
                            <x-dropdown-link href="{{ route('admin.fields') }}">Velden beheren</x-dropdown-link>
                            <x-dropdown-link href="{{ route('admin.season') }}">Seizoen</x-dropdown-link>
                            <x-dropdown-link href="{{ route('admin.hourlywages') }}">Trainersloon beheren</x-dropdown-link>
{{--                            financial administrator--}}
                        @elseif(auth()->user()->role->type == 'financieel beheerder')
                        <x-dropdown-link href="{{ route('financieel-beheerder.payment-registration') }}">Betaling registreren</x-dropdown-link>
                            <x-dropdown-link href="{{ route('financieel-beheerder.payment-methods') }}">Betaalmethode beheren</x-dropdown-link>
                            {{-- trainer only--}}
                        @elseif(auth()->user()->role->type == 'trainer')
                        <div class="block px-4 py-2 text-xs text-gray-400">Trainer</div>
                        <x-dropdown-link href="{{ route('trainer.distribution-list') }}">Verdeellijst weergeven</x-dropdown-link>
                        <x-dropdown-link href="{{ route('trainer.calender') }}">Voorkeur doorgeven</x-dropdown-link>
                        <x-dropdown-link href="{{ route('trainer.group-review') }}">Groep bekijken</x-dropdown-link>
                        <x-dropdown-link href="{{ route('trainer.expenses') }}">Onkost beheren</x-dropdown-link>
                        @endif
                    </x-slot>
                </x-dropdown>
            @endauth
    </div>
</nav>
