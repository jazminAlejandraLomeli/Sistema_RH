{{-- Vista inicial del sistema  --}}
@extends('admin.layouts.main')

@section('title', 'Inicio')

@section('viteConfig')
    @vite('resources/sass/home.scss')
@endsection

@section('titleView', 'Inicio')

@section('content')



    <div class="text-center mt-0">
        <h4 class="fst-italic fs-3"> Bienvenido de nuevo</h4>
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
