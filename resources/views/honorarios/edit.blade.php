{{-- Vista para ver los registros del personal en el sistema  --}}
@extends('admin.layouts.main')

@section('title', 'Editar honorario')
@section('viteConfig')
    @vite('resources/sass/StyleForm.scss')
@endsection
@section('titleView', 'Editar honorario')

@section('content')
    
    <div class="container">

        @include('honorarios.partials.form-edit')

    </div>
@endsection

@section('scripts')
    @vite('resources/js/honorarios/edit.js')
@endsection
