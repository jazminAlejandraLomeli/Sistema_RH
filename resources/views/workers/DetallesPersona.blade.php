{{-- Vista para ver los detalles de algun registro de personal  --}}
@extends('admin.layouts.main')

@section('title', 'Detalles')

@section('viteConfig')
    @vite(['resources/sass/StyleForm.scss'])
@endsection

@section('titleView', 'Detalles un trabajador')

@section('content')
    <div id="detalles-container" data-id="{{ $id }}"></div>

    {{-- Cards con los datos del trabajador --}}
    <div class="container">

        @include('workers.details.partials.personal-data')
        <br>
        {{-- Nombramiento principal --}}
        @include('workers.details.partials.first-job')
        <br>
        {{-- Mostrar solo si hay segundo nombramiento  --}}
        @if (!empty($Trabajo))
            @include('workers.details.partials.second-job')
        @endif
    </div>

    <br>
    <br>

    {{-- Controlar que es lo que puede ver el administrador  --}}
    @role('Administrador')

        @include('workers.details.partials.edit_modals.personal-data')
        {{-- No hay nombramientos habilitar agregar uno --}}
        @if (empty($Principal) && empty($Trabajo))
            @include('workers.details.partials.edit_modals.add-job')
        @elseif (!empty($Principal) && empty($Trabajo))
            <!-- Hay un nombramiento, se cargará el modal de edicion del nombramiento principal y el de agregar un nombramiento (secundario)    -->
            @include('workers.details.partials.edit_modals.add-job')

            @include('workers.details.partials.edit_modals.first-job')
        @else
            <!-- Hay dos nombramientos, se cargarán los 2 modales de edicion de los nombramientos y no el de agregar ya que el tope es 2 -->
            @include('workers.details.partials.edit_modals.first-job')
            @include('workers.details.partials.edit_modals.second-job')
        @endif
    @endrole
@endsection



{{-- Solo el usuario administrador  --}}
@section('scripts')
    @vite('resources/js/workers/details/PersonalData.js')

    @role('Administrador')
        @vite(['resources/js/workers/details/Nombramientos.js', 'resources/js/workers/details/new-Nombramiento.js'])
        @if (!empty($Principal) && !empty($Trabajo))
            @vite(['resources/js/workers/details/Principal.js', 'resources/js/workers/details/Secundario.js'])
        @elseif(!empty($Principal) && empty($Trabajo))
            @vite(['resources/js/workers/details/Principal.js'])
        @endif
    @endrole

@endsection
