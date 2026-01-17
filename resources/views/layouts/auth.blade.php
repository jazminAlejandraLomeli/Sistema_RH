<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/Rh_logo.png') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'System RH') }}</title>
    @yield('meta')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- login style -->
 
    <!-- Scripts -->
    @vite(['resources/sass/login.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <main class="width-custom py-4 px-4 ">
            @yield('content')
        </main>
    </div>

    {{-- Aquí inyectas scripts específicos de cada vista --}}
    @yield('scripts')
</body>

</html>
