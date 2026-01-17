<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/Rh_icon.png') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Cargar archivos que se usarán en todas las vistas -->
    <script src="{{ asset('js/jquery.min.js') }}"></script> <!-- jQuery -->
    {{-- <script src="{{ asset('js/popper.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> --}}

    @yield('viteConfig')
    @vite(['resources/sass/sideBar.scss', 'resources/js/SideBar.js', 'resources/sass/colorButtons.scss', 'resources/sass/loadingScreen.scss', 'resources/js/app.js'])

</head>

<body>
    <div id="app" class="position-relative">
        <section class="hamburger-container d-block d-md-none">
            <section class="hamburger-custom" id="hamburger">
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </a>
            </section>
        </section>
        {{-- Loading Screen --}}
        @include('admin.layouts.loadingScreen')
        {{-- Sidebard --}}
        @include('admin.layouts.sideBar')
        {{-- Contenido --}}
        <main class="container-custom pt-custom" id="containerMain">



            <h3 class="titleView-custom pt-3 text-center text-md-start border-bottom">@yield('titleView')</h3>

            @include('admin.layouts.breadcrumb', ['breadcrumbs' => $breadcrumbs])
            @yield('content')
        </main>
    </div>

    @vite('resources/js/helpers/generalFuntions.js')
    @yield('scripts')

</body>

</html>
