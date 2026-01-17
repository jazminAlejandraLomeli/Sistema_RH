@extends('admin.layouts.main')

@section('title', 'Usuarios')

@section('viteConfig')
    @vite(['resources/sass/users.scss', 'resources/sass/StyleForm.scss'])

@endsection
@section('titleView', 'Usuarios del sistema')

@section(section: 'content')
    <div class="container ">
        <div class="row">
            {{-- Cargar modales --}}
            @include('users.partials.details_user')
            @include('users.partials.add_user')
          
            <div class="col-12 d-block d-md-flex justify-content-between mt-2 mb-2">
                <div class="text-center text-md-start">
                    <p class="fs-4"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 22 22">
                            <path fill="#476EAE" d="M9 5H8v12h1v-1h1v-1h1v-1h1v-1h1v-1h1v-2h-1V9h-1V8h-1V7h-1V6H9" />
                        </svg>
                        <span>Usuarios registrados en el sistema</span>
                    </p>
                </div>

                <div class="flex-fill flex-lg-grow-0" data-bs-toggle="tooltip" data-bs-html="true"
                    data-bs-title="Agregar un nuevo usuario al sistema">
                    <x-next-button-component text="Agregar" data-bs-toggle="modal" data-bs-target="#Add-User" />
                </div>
            </div>

            <div class="col-12 bg-color-form pb-2">
                {{-- Tabla con el contenido de los usuarios registrados en el sistema --}}
                <div class="col-12 mt-0 pt-0">
                    <div id="Tabla-usuarios"></div>
                </div>
            </div>

        </div>
    </div>


    <br>
    <br>
@endsection

@section('scripts')

    @vite(['resources/js/users/add_user.js', 'resources/js/users/update_user.js'])

    @vite('resources/js/users/index.js')
@endsection
