{{-- Vista para ver los detalles de algun registro de personal  --}}
@extends('admin.layouts.main')

@section('title', 'Actualizar')

@section('viteConfig')
    @vite(['resources/sass/StyleForm.scss'])
@endsection

@section('titleView', 'Actualizar nombramiento')

@section('content')

    <div class="mx-3 ">

        @php
            $nombramientos = $Selects['nombramientos'];
            $departamentos = $Selects['departamentos'];
            $gender = $Selects['gender'];
            $Title = $Selects['Title'];
            $Principal = $Selects['Principal'];
            $categorias = $Selects['C_Categories'];
            $Distinciones = $Selects['Distinciones'];
            $Estados = $Selects['Estados'];

        @endphp

        <input type="hidden" id="id-worker" value="{{ $Worker->id }}">
        <input type="hidden" id="principal" value="{{ $Principal }}">
        <input type="hidden" id="id_work" value="{{ $Data->id }}">
        {{-- <input type="hidden" id="id_address" value="{{ $id_address }}"> --}}

        {{-- Detalles de la persona para saber a quien le estan actualizando los datos del domicilio --}}
        @include('workers.details.job.partials.resume')

        {{-- Formulario para actualizar los datos personales --}}
        @include('workers.details.update.partials.job-data-form')

    </div>
    <br>
    <br>

@endsection


@section('scripts')
    @vite('resources/js/workers/details/update/jobs/index.js')
@endsection
