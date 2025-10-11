@extends('admin.layouts.main')

@section('title', 'Usuarios')

@section('viteConfig')
    @vite('resources/sass/users.scss')

@endsection
@section('titleView', 'Usuarios del sistema')

@section('content')
    <div class="container ">
        <div class="row justify-content-center ">
            <div class="col-12 d-flex justify-content-center">
                <h5 class="text-center mt-1"> Usuarios registrados en el sistema </h5>
            </div>
            <div class="mt-2 col-12 mb-2 d-flex justify-content-end mx-4 px-4">

                <abbr data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="<b>Agregar</b> un nuevo usuario al sistema">
                    <button data-bs-toggle="modal" data-bs-target="#Add-User"
                        class="btn fst-normal px-3 animated-icon button-add" type="button" id="confirm-report"
                        tabindex="0">
                        <i class="fa-solid fa-user-plus "></i>
                        Agregar
                    </button>
                </abbr>
                
            </div>

            <div class="col-12 bg-color-form pb-2">
                {{-- Tabla con el contenido de los usuarios registrados en el sistema --}}
                <div class="col-12 mt-0 pt-0">
                    <div id="Tabla-usuarios"></div>
                </div>

            </div>
        </div>
    </div>

    @include('users.partials.details_user')
    @include('users.partials.add_user')
    <br>
    <br>
@endsection

@section('scripts')

    @vite(['resources/js/users/add_user.js', 'resources/js/users/update_user.js'])

    @vite('resources/js/users/index.js')
@endsection
