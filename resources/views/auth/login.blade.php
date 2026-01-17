@extends('layouts.auth')

@section('meta')
    <meta name="description" content="Accede al sistema SIP-CUAltos.">
 @endsection

@section('content')
    <div class="container-custom-login rounded-4">
        <div class="black-screen-custom">

        </div>
        <div class="row height-custom up-container-custom">

            <div class="col-12 col-md-6 py-3 px-4">
                <div class="container-custom-image rounded-3">

                </div>
            </div>

            <div class="col-12 col-md-6 height-custom">
                <div class="row d-flex justify-content-center align-content-center height-custom pt-lg-5">
                    <div class="col-12 col-md-11 col-lg-10 col-xl-9 col-xxl-7">
                        <div class="col-12 px-5 pt-5 pt-lg-0 pb-2  text-center text-lg-start">
                            <h1 class="fw-bold title-custom">Bienvenido</h1>
                            <p class="text-sm">Ingresa el usuario y contraseña para acceder</p>
                        </div>

                        <!-- Mostrar los errores -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>¡Ups! Algo salió mal.</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Cerrar"></button>
                            </div>
                        @endif

                        <form class="px-md-5" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="user_name" class="form-label">Usuario</label>
                                <input type="text" class="form-control form-control-custom py-2 form-label"
                                    id="user_name" aria-describedby="user_name" name="user_name"
                                    value="{{ old('user_name') }}" maxlength="7">
                            </div>
                            <div class="mb-3">
                                {{-- <label for="password" class="form-label">Contraseña</label>
                                {{-- <input type="password" class="form-control form-control-custom py-2" id="password" name="password" > 

                                <div class="input-group">
                                    <input type="password" class="form-control form-control-custom py-2" id="password"
                                        name="password">
                                    <button class="btn btn-primary-custom" type="button" id="togglePassword">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="#373CC4"><path d="M2 8s4.477-5 10-5s10 5 10 5"/><path d="M21.544 13.045c.304.426.456.64.456.955c0 .316-.152.529-.456.955C20.178 16.871 16.689 21 12 21c-4.69 0-8.178-4.13-9.544-6.045C2.152 14.529 2 14.315 2 14c0-.316.152-.529.456-.955C3.822 11.129 7.311 7 12 7c4.69 0 8.178 4.13 9.544 6.045"/><path d="M15 14a3 3 0 1 0-6 0a3 3 0 0 0 6 0"/></g></svg>
                                    </button>
                                </div> --}}

                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-custom py-2" id="password"
                                            name="password">
                                        <span class="input-group-text" id="togglePassword"
                                            style="cursor:pointer; background:#064E3B;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24">
                                                <g fill="none" stroke="#ffffff" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5">
                                                    <path d="M2 8s4.477-5 10-5s10 5 10 5" />
                                                    <path
                                                        d="M21.544 13.045c.304.426.456.64.456.955c0 .316-.152.529-.456.955C20.178 16.871 16.689 21 12 21c-4.69 0-8.178-4.13-9.544-6.045C2.152 14.529 2 14.315 2 14c0-.316.152-.529.456-.955C3.822 11.129 7.311 7 12 7c4.69 0 8.178 4.13 9.544 6.045" />
                                                    <path d="M15 14a3 3 0 1 0-6 0a3 3 0 0 0 6 0" />
                                                </g>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center pt-4">
                                <button type="submit"
                                    class="btn btn-primary-custom px-5 py-2 w-100 w-md-0">Ingresar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection

@section('scripts')
    @vite('resources/js/helpers/login.js')
@endsection
