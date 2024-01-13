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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-sidebar />
    <div class="wrapper d-flex flex-column min-vh-100 bg-light dark:bg-transparent">
        <x-header />
        <div class="body flex-grow-1 px-3">
            <div class="container-xl">
                {{ $breadcrumb }}

                {{ $slot }}

            </div>
        </div>

        <x-footer />
    </div>
</body>

</html>
