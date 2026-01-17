{{-- Vista para ver los detalles de algun registro de personal  --}}
@extends('admin.layouts.main')

@section('title', 'Detalles')

@section('viteConfig')
    @vite(['resources/sass/StyleForm.scss'])
@endsection

@section('titleView', 'Agregar nombramiento')

@section('content')
    <div class="container ">
        <div id="detalles-container" data-id="{{ $id }}"></div>
        @php
            if ($count === 0) {
                $count = 1;
            } else {
                $count = 0;
            }
        @endphp
        <input type="hidden" value="{{ $count }}" id="principal" class="d-none">
        <div class="mx-3 ">
            {{-- Detalles de la persona para agregar el nombramiento --}}
            @include('workers.details.job.partials.resume')

            {{-- Formlario de nombramiento --}}
            @include('workers.new-worker.partials.job-form')

        </div>
    </div>

    <br>

@endsection


@section('scripts')
    @vite('resources/js/workers/add-job/index.js')
@endsection
