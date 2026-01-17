{{-- Vista para ver los registros del personal en el sistema  --}}
@extends('admin.layouts.main')

@section('title', 'Personal')
@section('viteConfig')
    @vite('resources/sass/StyleForm.scss')
@endsection
@section('titleView', 'Personal registrado')

@section('content')
    <div class="container ">
        <div class="row">

            <div class="col-12 d-block d-md-flex justify-content-between mt-2 mb-2">
                <div class="text-center text-md-start">
                    <p class=" fs-5"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 22 22">
                            <path fill="#476EAE" d="M9 5H8v12h1v-1h1v-1h1v-1h1v-1h1v-1h1v-2h-1V9h-1V8h-1V7h-1V6H9" />
                        </svg>
                        <span class="title">Personal registrado</span>
                    </p>
                </div>

                <div class="d-flex justify-content-center">
                    @role('Administrador')
                        <div class="flex-fill flex-lg-grow-0" data-bs-toggle="tooltip" data-bs-html="true"
                            data-bs-title="<b>Agregar</b> una nuevo trabajador al sistema">
                            <x-next-button-component text="Agregar" href="{{ route('personal.agregar_personal') }}" />
                        </div>
                    @endrole
                </div>
            </div>

            <div class="col-12 bg-color-form pb-2">
                <div class="col-12 mt-0 pt-0">
                    {{-- Tabla del personal --}}
                    <div id="Tabla-Personal"></div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
@endsection

@section('scripts')
    @vite('resources/js/workers/index.js')
@endsection
