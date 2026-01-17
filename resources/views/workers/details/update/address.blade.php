{{-- Vista para ver los detalles de algun registro de personal  --}}
@extends('admin.layouts.main')

@section('title', 'Actualizar')

@section('viteConfig')
    @vite(['resources/sass/StyleForm.scss'])
@endsection

@section('titleView', 'Actualizar domicilio')

@section('content')

    <div class="mx-3 ">

        @php if(empty($Worker->domicilio)) {
                $id_address = "";
            } else {
                $id_address = $Worker->domicilio->id;
            }
        @endphp


                <input type="hidden" id="id" value="{{ $Worker->id }}">
                <input type="hidden" id="id_address" value="{{ $id_address }}">

        {{-- Detalles de la persona para saber a quien le estan actualizando los datos del domicilio --}}
        @include('workers.details.job.partials.resume')

        {{-- Formulario para actualizar los datos personales --}}
        @include('workers.details.update.partials.address-data-form')

    </div>
    <br>
    <br>

@endsection


@section('scripts')
    @vite('resources/js/workers/details/update/address/index.js')
@endsection
