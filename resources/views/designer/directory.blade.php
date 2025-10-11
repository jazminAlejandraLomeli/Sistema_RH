{{-- Vista para ver los registros del personal en el sistema  --}}
@extends('admin.layouts.main')

@section('title', 'Directorio')
@section('viteConfig')
    @vite('resources/sass/StyleForm.scss')
@endsection
@section('titleView', 'Directorio del Centro Universitario de los Altos')

@section('content')

    <div class="container ">
        <div class="row justify-content-center ">
            <div class="col-12 d-flex justify-content-center">
                <h5 class="text-center mt-1">Personal del Centro Universitario</h5>
            </div>
            <div class="col-12 bg-color-form pb-2">

                <div class="col-12 mt-0 pt-0">
                    <div id="personalTable"></div>
                </div>

            </div>
        </div>
        @include('designer.partials.modal-edit-photo')

    </div>
@endsection

@section('scripts')
    @vite('resources/js/designer/index.js')
@endsection
