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
        <link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet"/>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/nanogallery2@3/dist/css/nanogallery2.min.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/nanogallery2@3/dist/jquery.nanogallery2.min.js"></script>
        <!-- Scripts -->
        
        @vite(['resources/css/app.css', 'resources/js/app.js','node_modules/@pqina/pintura/pintura.css'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <div id="header" class="fixed w-full shadow z-50">
                @include('layouts.navigation')
            </div>
 
            <div id="content" class="flex flex-row w-full">
                @if (isset($header))
                    {{$header}}
                @endif
                <!-- Page Content -->
                <main id="main" class="w-full">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
    <script type="module">
    $(window).on('load',function() {
        var contentPlacement = $('#header').position().top + $('#header').height();
        $('#content').css('padding-top',contentPlacement);

        var sidePlacement = $('#side-bar').position().left + $('#side-bar').width();
        $('#main').css('padding-left',sidePlacement+30);
    });
    </script>
</html>
