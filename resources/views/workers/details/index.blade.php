{{-- Vista para ver los detalles de algun registro de personal  --}}
@extends('admin.layouts.main')

@section('title', 'Detalles')

@section('viteConfig')
    @vite(['resources/sass/StyleForm.scss'])
@endsection

@section('titleView', 'Detalles un trabajador')

@section('content')

    <div class="mx-3 ">
        {{-- Boton de agregar un nombramiento --}}
        @include('workers.details.partials.botton-add-job')
        {{-- Formulario de datos personales --}}
        @include('workers.details.partials.personal')

        {{-- Formulario de domicilio --}}
        @include('workers.details.partials.address')

        {{-- Formulario de nombramientos --}}
        <div class="mt-3">
            @include('workers.details.partials.jobs')
        </div>


    </div>


    <br>
    <br>

@endsection


@section('scripts')
    @vite('resources/js/workers/details/index.js')
@endsection

{{-- @section('scripts')
    @vite('resources/js/workers/details/PersonalData.js')

    @role('Administrador')
        @vite(['resources/js/workers/details/Nombramientos.js', 'resources/js/workers/details/new-Nombramiento.js'])
        @if (!empty($Principal) && !empty($Trabajo))
            @vite(['resources/js/workers/details/Principal.js', 'resources/js/workers/details/Secundario.js'])
        @elseif(!empty($Principal) && empty($Trabajo))
            @vite(['resources/js/workers/details/Principal.js'])
        @endif
    @endrole

@endsection --}}
