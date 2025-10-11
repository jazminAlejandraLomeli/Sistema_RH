{{-- Vista para ver los registros del personal en el sistema  --}}
@extends('admin.layouts.main')

@section('title', 'Agregar honorario')
@section('viteConfig')
    @vite('resources/sass/StyleForm.scss')
@endsection
@section('titleView', 'Agregar honorario')

@section('content')
    
    <div class="container">

        @include('honorarios.partials.form-create')

    </div>
@endsection

@section('scripts')
    @vite('resources/js/honorarios/create.js')
@endsection
