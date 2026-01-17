{{-- Vista inicial del sistema  --}}
@extends('admin.layouts.main')

@section('title', 'Inicio')


@section('meta')
    <meta name="description"
        content="Sistema SIP-CUAltos para la administración del personal, control de información y reportes institucionales.">
@endsection


@section('viteConfig')
    @vite(['resources/sass/home.scss'])
@endsection

@section('titleView', 'Inicio')

@section('content')

    @include('home.partials.modal-table')
    @include('home.partials.modal-today-hbd')

    <div class="m-2 d-flex justify-content-between px-1">
        <div>
            <h1 class="fst-italic fs-3"> Bienvenido de nuevo</h1>
        </div>
        <div data-bs-toggle="tooltip" data-bs-html="true" data-bs-title=" {{ $hbd_today['count'] }} cumpleañeros del día">
            <button class="modal-btn today" data-bs-toggle="modal" data-bs-target="#today-birthdays">
                <x-confetty-component type="today" />
            </button>
        </div>
    </div>


    <div class="container-fluid">

        @include('home.card-details-workers')
        @include('home.card-contracts')
        @include('home.card-gender')

    </div>
    <br>

    <br>


@endsection




@section('scripts')
    @vite('resources/js/home/index.js')
@endsection
