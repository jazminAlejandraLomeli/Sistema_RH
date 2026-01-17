@extends('admin.layouts.main')

@section('title', 'Logs')

@section('viteConfig')
    @vite(['resources/sass/StyleForm.scss', 'resources/sass/logs.scss'])

@endsection
<livewire:styles />

@section('titleView', 'Logs del sistema')

@section(section: 'content')
    <div class="container ">
        <div class="row">

            <div class="col-12 d-block d-md-flex justify-content-between mt-2 mb-2">
                <div class="text-center text-md-start">
                    <p class="fs-4"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 22 22">
                            <path fill="#476EAE" d="M9 5H8v12h1v-1h1v-1h1v-1h1v-1h1v-1h1v-2h-1V9h-1V8h-1V7h-1V6H9" />
                        </svg>
                        <span>Acciones de los usuarios</span>
                    </p>
                </div>
            </div>


            {{-- Componente de live wire --}}
            <div>
                <livewire:logs-list />
            </div>

            <div id="pagination-loader" class="d-none text-center my-3">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>


        </div>
    </div>


    <br>
    <br>
@endsection

@section('scripts')
    <livewire:scripts />
    @vite(['resources/js/logs/index.js'])

@endsection
