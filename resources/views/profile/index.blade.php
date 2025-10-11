@extends('admin.layouts.main')

@section('title', 'Mi perfil')

@section('viteConfig')
    @vite('resources/sass/users.scss')
@endsection

@section('titleView', 'Mi perfil')

@section('content')
    {{-- {{ $usuario}} --}}
    <div class="container ">
        <div class="row justify-content-center ">
            <div class="col-12 d-flex justify-content-center">
                <h5 class="text-center mt-1"> Información de mi perfil </h5>
            </div>
            <div class="row mt-4">
                <div class="col-sm-12 col-md-6 col-xl-6">
                    <x-icon-cont
                        icon='<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 50 50"><path fill="#0284c7" d="M25.1 42c-9.4 0-17-7.6-17-17s7.6-17 17-17s17 7.6 17 17s-7.7 17-17 17m0-32c-8.3 0-15 6.7-15 15s6.7 15 15 15s15-6.7 15-15s-6.8-15-15-15"/><path fill="#0284c7" d="m15.3 37.3l-1.8-.8c.5-1.2 2.1-1.9 3.8-2.7s3.8-1.7 3.8-2.8v-1.5c-.6-.5-1.6-1.6-1.8-3.2c-.5-.5-1.3-1.4-1.3-2.6c0-.7.3-1.3.5-1.7c-.2-.8-.4-2.3-.4-3.5c0-3.9 2.7-6.5 7-6.5c1.2 0 2.7.3 3.5 1.2c1.9.4 3.5 2.6 3.5 5.3c0 1.7-.3 3.1-.5 3.8c.2.3.4.8.4 1.4c0 1.3-.7 2.2-1.3 2.6c-.2 1.6-1.1 2.6-1.7 3.1V31c0 .9 1.8 1.6 3.4 2.2c1.9.7 3.9 1.5 4.6 3.1l-1.9.7c-.3-.8-1.9-1.4-3.4-1.9c-2.2-.8-4.7-1.7-4.7-4v-2.6l.5-.3s1.2-.8 1.2-2.4v-.7l.6-.3c.1 0 .6-.3.6-1.1c0-.2-.2-.5-.3-.6l-.4-.4l.2-.5s.5-1.6.5-3.6c0-1.9-1.1-3.3-2-3.3h-.6l-.3-.5c0-.4-.7-.8-1.9-.8c-3.1 0-5 1.7-5 4.5c0 1.3.5 3.5.5 3.5l.1.5l-.4.5c-.1 0-.3.3-.3.7c0 .5.6 1.1.9 1.3l.4.3v.5c0 1.5 1.3 2.3 1.3 2.4l.5.3v2.6c0 2.4-2.6 3.6-5 4.6c-1.1.4-2.6 1.1-2.8 1.6"/></svg>'
                        label="Nombre de usuario" text="{{ $usuario->user_name }}" id="user_name" />
                </div>
                <div class="col-sm-12 col-md-6 col-xl-6">
                    <x-icon-cont
                        icon='<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 36 36"><path fill="#0284c7" d="M32 13.22V30H4V8h3V6H3.75A1.78 1.78 0 0 0 2 7.81v22.38A1.78 1.78 0 0 0 3.75 32h28.5A1.78 1.78 0 0 0 34 30.19V12.34a7.5 7.5 0 0 1-2 .88" class="clr-i-outline--badged clr-i-outline-path-1--badged"/><path fill="#0284c7" d="M8 14h2v2H8z" class="clr-i-outline--badged clr-i-outline-path-2--badged"/><path fill="#0284c7" d="M14 14h2v2h-2z" class="clr-i-outline--badged clr-i-outline-path-3--badged"/><path fill="#0284c7" d="M20 14h2v2h-2z" class="clr-i-outline--badged clr-i-outline-path-4--badged"/><path fill="#0284c7" d="M26 14h2v2h-2z" class="clr-i-outline--badged clr-i-outline-path-5--badged"/><path fill="#0284c7" d="M8 19h2v2H8z" class="clr-i-outline--badged clr-i-outline-path-6--badged"/><path fill="#0284c7" d="M14 19h2v2h-2z" class="clr-i-outline--badged clr-i-outline-path-7--badged"/><path fill="#0284c7" d="M20 19h2v2h-2z" class="clr-i-outline--badged clr-i-outline-path-8--badged"/><path fill="#0284c7" d="M26 19h2v2h-2z" class="clr-i-outline--badged clr-i-outline-path-9--badged"/><path fill="#0284c7" d="M8 24h2v2H8z" class="clr-i-outline--badged clr-i-outline-path-10--badged"/><path fill="#0284c7" d="M14 24h2v2h-2z" class="clr-i-outline--badged clr-i-outline-path-11--badged"/><path fill="#0284c7" d="M20 24h2v2h-2z" class="clr-i-outline--badged clr-i-outline-path-12--badged"/><path fill="#0284c7" d="M26 24h2v2h-2z" class="clr-i-outline--badged clr-i-outline-path-13--badged"/><path fill="#0284c7" d="M10 10a1 1 0 0 0 1-1V3a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1" class="clr-i-outline--badged clr-i-outline-path-14--badged"/><path fill="#0284c7" d="M22.5 6H13v2h9.78a7.5 7.5 0 0 1-.28-2" class="clr-i-outline--badged clr-i-outline-path-15--badged"/><circle cx="30" cy="6" r="5" fill="#0284c7" class="clr-i-outline--badged clr-i-outline-path-16--badged clr-i-badge"/><path fill="none" d="M0 0h36v36H0z"/></svg>'
                        label="Fecha de ingreso" text="{{ $usuario->Created_data }}" id="date" />
                </div>


                <div class="col-sm-12 col-md-6 col-xl-6">
                    <x-icon-cont
                        icon='<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><g fill="none" stroke="#0284c7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path stroke-dasharray="20" stroke-dashoffset="20" d="M12 5c1.66 0 3 1.34 3 3c0 1.66 -1.34 3 -3 3c-1.66 0 -3 -1.34 -3 -3c0 -1.66 1.34 -3 3 -3Z"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="20;0"/></path><path stroke-dasharray="36" stroke-dashoffset="36" d="M12 14c4 0 7 2 7 3v2h-14v-2c0 -1 3 -3 7 -3Z"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.5s" dur="0.5s" values="36;0"/></path></g></svg>'
                        label="Nombre" text="{{ $usuario->name }}" id="name" />
                </div>

                <div class="col-sm-12 col-md-6 col-xl-6">
                    <x-icon-cont
                        icon='<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 36 36"><path fill="#0284c7" d="M14.68 14.81a6.76 6.76 0 1 1 6.76-6.75a6.77 6.77 0 0 1-6.76 6.75m0-11.51a4.76 4.76 0 1 0 4.76 4.76a4.76 4.76 0 0 0-4.76-4.76" class="clr-i-outline clr-i-outline-path-1"/><path fill="#0284c7" d="M16.42 31.68A2.14 2.14 0 0 1 15.8 30H4v-5.78a14.8 14.8 0 0 1 11.09-4.68h.72a2.2 2.2 0 0 1 .62-1.85l.12-.11c-.47 0-1-.06-1.46-.06A16.47 16.47 0 0 0 2.2 23.26a1 1 0 0 0-.2.6V30a2 2 0 0 0 2 2h12.7Z" class="clr-i-outline clr-i-outline-path-2"/><path fill="#0284c7" d="M26.87 16.29a.4.4 0 0 1 .15 0a.4.4 0 0 0-.15 0" class="clr-i-outline clr-i-outline-path-3"/><path fill="#0284c7" d="m33.68 23.32l-2-.61a7.2 7.2 0 0 0-.58-1.41l1-1.86A.38.38 0 0 0 32 19l-1.45-1.45a.36.36 0 0 0-.44-.07l-1.84 1a7 7 0 0 0-1.43-.61l-.61-2a.36.36 0 0 0-.36-.24h-2.05a.36.36 0 0 0-.35.26l-.61 2a7 7 0 0 0-1.44.6l-1.82-1a.35.35 0 0 0-.43.07L17.69 19a.38.38 0 0 0-.06.44l1 1.82a6.8 6.8 0 0 0-.63 1.43l-2 .6a.36.36 0 0 0-.26.35v2.05A.35.35 0 0 0 16 26l2 .61a7 7 0 0 0 .6 1.41l-1 1.91a.36.36 0 0 0 .06.43l1.45 1.45a.38.38 0 0 0 .44.07l1.87-1a7 7 0 0 0 1.4.57l.6 2a.38.38 0 0 0 .35.26h2.05a.37.37 0 0 0 .35-.26l.61-2.05a7 7 0 0 0 1.38-.57l1.89 1a.36.36 0 0 0 .43-.07L32 30.4a.35.35 0 0 0 0-.4l-1-1.88a7 7 0 0 0 .58-1.39l2-.61a.36.36 0 0 0 .26-.35v-2.1a.36.36 0 0 0-.16-.35M24.85 28a3.34 3.34 0 1 1 3.33-3.33A3.34 3.34 0 0 1 24.85 28" class="clr-i-outline clr-i-outline-path-4"/><path fill="none" d="M0 0h36v36H0z"/></svg>'
                        label="Rol / Tipo de usuario" text="{{ $usuario->role }}" id="role" />
                </div>

                <div class="col d-flex justify-content-start ">
                    <abbr data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="Actualizar contraseña.">
                        <button class="btn fst-normal px-2 animated-icon button-details" type="button" tabindex="0"
                            data-bs-toggle="collapse" data-bs-target="#Password" aria-expanded="false"
                            aria-controls="collapseExample">
                            <i class="fa-solid fa-key"></i>
                            Contraseña
                        </button>
                    </abbr>
                </div>

                @include('profile.partials.collapse_change_password')


            </div>
        </div>


        <br>
        <br>
    @endsection

    @section('scripts')

        @vite('resources/js/profile/index.js')
    @endsection
