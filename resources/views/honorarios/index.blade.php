{{-- Vista para ver los registros del personal en el sistema  --}}
@extends('admin.layouts.main')

@section('title', 'Honorarios')
@section('viteConfig')
    @vite('resources/sass/StyleForm.scss')
@endsection
@section('titleView', 'Lista del personal registrado')

@section('content')
    <div class="container ">
        <div class="row justify-content-center ">
                 <h5 class="text-center mt-1">Personal con Contratos de Honorarios </h5>
             @role('Administrador')
                <div class="mt-2 col-12 mb-2 d-flex justify-content-end mx-4 px-4">
                    <abbr data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="<b>Agregar</b> una nuevo trabajador con Honorarios">
                        <a href="{{ route('personal.agregar_personal') }}" class="btn fst-normal px-3 animated-icon button-add"
                            type="button" id="confirm-report" tabindex="0">
                            <i class="fa-solid fa-user-plus "></i>
                            Agregar
                        </a>
                    </abbr>
                </div>
            @endrole
            <div class="col-12 bg-color-form pb-2">
                <div class="col-12 mt-0 pt-0">
                    <div id="Tabla-Honorarios"></div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    @vite('resources/js/honorarios/index.js')
@endsection
 