{{-- Vista para ver los registros del personal en el sistema  --}}
@extends('admin.layouts.main')

@section('title', 'Detalles')
@section('viteConfig')
    @vite('resources/sass/StyleForm.scss')
@endsection
@section('titleView', 'Detalles Honorarios')

@section('content')

    @role('Administrador')
        {{-- Modal para editar los datos del trabajador --}}
        @include('honorarios.details.partials.modal-edit')
    @endrole
    <div class="container">
        @include('honorarios.details.partials.personal-data')

    </div>


@endsection

@section('scripts')
    @vite('resources/js/honorarios/details/index.js')
@endsection
