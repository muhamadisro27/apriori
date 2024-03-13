<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @include('includes.style')
</head>

<body>
    <x-sidebar />
    <div class="wrapper d-flex flex-column min-vh-100 bg-light dark:bg-transparent">
        <x-header />
        <div class="px-3 body flex-grow-1">
            <div class="container-xxl">
                {{ $breadcrumb }}

                {{ $slot }}

            </div>
        </div>

        <x-footer />
    </div>

    @include('includes.script')
</body>

</html>
