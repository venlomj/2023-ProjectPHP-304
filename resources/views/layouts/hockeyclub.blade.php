<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>--}}

    <meta name="description" content="{{ $description ?? 'Welcome to the Hockeyclub' }}">
    <title>Hockeyclub: {{ $title ?? 'Home' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles()
    @livewire('layout.nav-bar')
    <x-layout.favicons></x-layout.favicons>
</head>
<style>
    body {
        font-family: 'Montserrat', sans-serif;
        letter-spacing: 1.1px;
    }
</style>


<body class="antialiased">
{{--<x-layout.nav/>--}}
<div class="flex flex-col space-y-4 min-h-screen text-gray-800 bg-gray-100">

    <main class="container mx-auto flex-1">
        <div class="bg-white py-20 sm:py-20 px-10 sm:px-5">
            <div class="mx-auto max-w-7xl px-6 lg:px-2">
                <div class="lg:flex lg:items-center lg:justify-between">
                    <div class="min-w-0 flex-1">

                        <h2 class="text-4xl font-bold font-sans"><span class="text-blue-500"> {{ $title ?? ''}} </span></h2>
                        <p class="mt-1 text-lg leading-8 text-gray-600"> {{ $description ?? ''  }}</p>


                        <div class="mt-3 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6">
                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                <svg class="mr-1.5 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59" />
                                </svg>
{{--                                {{ $type }}--}}
                            </div>
                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" />
                                </svg>
{{--                                {{ $date }}--}}
                            </div>
                        </div>
                    </div>

{{--                    {{ $knop }}--}}

                </div>

                <div class="mx-auto mt-6 border-t border-5 border-gray-200 pt-8">
                    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                        <!-- Replace with your content -->
                        <div class="px-4 py-6 sm:px-0">

                            {{ $slot }}

                        </div>
                        <!-- /End replace -->
                    </div>
                    <!-- More posts... -->
                </div>

{{--                <div class="px-4 py-3 text-left sm:px-6 flex flex-wrap justify-between">--}}
{{--                    <button class="inline-flex block  rounded-md border border-transparent bg-blue-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"><span aria-hidden="true" class="mr-2"> &larr; </span> Back</button>--}}
{{--                    <button type="submit" class="inline-flex block justify-between rounded-md border border-transparent bg-blue-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"><span aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75" />--}}
{{--                    </svg></span></button>--}}

{{--                </div>--}}{{-- Dit heb ik voorlopig in commentaar gezet.--}}
            </div>
        </div>

    </main>
    <x-layout.footer />
</div>
@stack('script')
@livewireScripts
</body>
</html>
