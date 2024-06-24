<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet" />

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/nanogallery2@3/dist/css/nanogallery2.min.css" rel="stylesheet"
        type="text/css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/nanogallery2@3/dist/jquery.nanogallery2.min.js">
    </script>
    <!-- Scripts -->

    @vite(['resources/css/app.css', 'resources/js/app.js', 'node_modules/@pqina/pintura/pintura.css'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white">
        <div id="header" class="fixed w-full shadow z-50">
            @include('layouts.navigation')
        </div>

        <div x-data="{ open: false, requestOpen: false }" @click.away="open = false, requestOpen = false" id="content"
            class="flex flex-row w-full">

            @if (isset($header))
                <button @click="open = !open; $('#mobile-sidebar').removeClass('hidden');"
                    class="max-md:block hidden fixed top-[50%] bg-rose-500 z-30 rounded-r-xl">
                    <svg class="w-5 h-5" fill="#FFFFFF" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

                <div style="flex: 0 0 240px;" class="max-md:hidden">
                    {{ $header }}
                </div>

                <div id='mobile-sidebar' x-show="open" x-transition:enter="transform transition ease-out duration-300"
                    x-transition:enter-start="translate-x-[-240px]" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in duration-200"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-[-240px]"
                    class="z-30 hidden">
                    @if (isset($header))
                        {{ $header }}
                    @endif
                </div>
            @endif

            <button @click="requestOpen = !requestOpen; $('#request-sidebar').removeClass('hidden');"
                class="rounded-t-xl p-1 fixed top-[50%] right-0 bg-rose-500 z-30 -rotate-90 mr-[-20px]">
                <span class="text-white ">Request</span>
            </button>

            <div id='request-sidebar' x-show="requestOpen"
                x-transition:enter="transform transition ease-out duration-300"
                x-transition:enter-start="translate-x-[240px]" x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition ease-in duration-200" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-[240px]" class="z-30 hidden fixed right-0">
                <div class="bg-gray-100 h-screen w-[344px] shadow flex flex-col gap-4 p-4 pt-20">
                    @include('layouts.request')
                </div>
            </div>

            <!-- Page Content -->
            <main @click="open = false, requestOpen = false" style="flex: 1 1 auto; -ms-overflow-style: none; scrollbar-width: none;" id="main"
                class="w-full pt-12 overflow-x-hidden">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
