{{-- Vista para ver los detalles de algun registro de personal  --}}
@extends('admin.layouts.main')

@section('title', 'Actualizar')

@section('viteConfig')
    @vite(['resources/sass/StyleForm.scss'])
@endsection

@section('titleView', 'Actualizar datos personales')

@section('content')

    <div class="mx-3 ">

        <input type="hidden" id="id" value="{{ $worker->id }}">
        {{-- Formulario para actualizar los datos personales --}}
        @include('workers.details.update.partials.personal-data-form')
        
    </div>
    <br>
    <br>

@endsection


@section('scripts')
    @vite('resources/js/workers/details/update/personal-data/index.js')
@endsection
