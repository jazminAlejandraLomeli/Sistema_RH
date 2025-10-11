<div class="card shadow-sm animate__animated animate__fadeInDown">
    <div class="card-body">
        <h5 class="card-title text-center">Datos Personales</h5>
        <div class="row pt-2">
            <div class="col-12 col-md-6 col-xl-6">

                <div class="row pt-2">
                    <div class="form-group col-6">
                        <x-icon-cont
                            icon=' <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                 <g fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="1.5" color="#373CC4">
                                     <path
                                         d="M8.5 18c1.813-1.954 5.167-2.046 7 0m-1.56-6c0 1.105-.871 2-1.947 2c-1.075 0-1.947-.895-1.947-2s.872-2 1.947-2s1.948.895 1.948 2" />
                                     <path
                                         d="M9.5 4.002c-2.644.01-4.059.102-4.975.97C3.5 5.943 3.5 7.506 3.5 10.632v4.737c0 3.126 0 4.69 1.025 5.66c1.025.972 2.675.972 5.975.972h3c3.3 0 4.95 0 5.975-.971c1.025-.972 1.025-2.535 1.025-5.66v-4.738c0-3.126 0-4.689-1.025-5.66c-.916-.868-2.33-.96-4.975-.97" />
                                     <path
                                         d="M9.772 3.632c.096-.415.144-.623.236-.792a1.64 1.64 0 0 1 1.083-.793C11.294 2 11.53 2 12 2s.706 0 .909.047a1.64 1.64 0 0 1 1.083.793c.092.17.14.377.236.792l.083.36c.17.735.255 1.103.127 1.386a1.03 1.03 0 0 1-.407.451C13.75 6 13.332 6 12.498 6h-.996c-.834 0-1.252 0-1.533-.17a1.03 1.03 0 0 1-.407-.452c-.128-.283-.043-.65.127-1.386z" />
                                 </g>
                             </svg>'
                            label="Código" text="{{ $Persona->codigo }}" id="Person_Code" />

                    </div>

                    <div class="form-group col-6">
                        @if ($Persona->sexo == 'Femenino')
                            <x-icon-cont
                                icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#c026d3" d="M12 4a6 6 0 0 1 6 6c0 2.97-2.16 5.44-5 5.92V18h2v2h-2v2h-2v-2H9v-2h2v-2.08c-2.84-.48-5-2.95-5-5.92a6 6 0 0 1 6-6m0 2a4 4 0 0 0-4 4a4 4 0 0 0 4 4a4 4 0 0 0 4-4a4 4 0 0 0-4-4"/></svg>'
                                label="Género" text="{{ $Persona->sexo }}" id="Person_sex" />
                        @else
                            <x-icon-cont
                                icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#4f46e5" d="M9 9c1.29 0 2.5.41 3.47 1.11L17.58 5H13V3h8v8h-2V6.41l-5.11 5.09c.7 1 1.11 2.2 1.11 3.5a6 6 0 0 1-6 6a6 6 0 0 1-6-6a6 6 0 0 1 6-6m0 2a4 4 0 0 0-4 4a4 4 0 0 0 4 4a4 4 0 0 0 4-4a4 4 0 0 0-4-4"/></svg>'
                                label="Género" text="{{ $Persona->sexo }}" id="Person_sex" />
                        @endif


                    </div>
                </div>

                <x-icon-cont
                    icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20.75a1 1 0 0 0 1-1v-1.246c.004-2.806-3.974-5.004-8-5.004s-8 2.198-8 5.004v1.246a1 1 0 0 0 1 1zM15.604 6.854a3.604 3.604 0 1 1-7.208 0a3.604 3.604 0 0 1 7.208 0"/></svg>'
                    label="Nombre Completo" text="{{ $Persona->nombre }}" id="Person_Name" />

                <x-icon-cont
                    icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><g fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path stroke-dasharray="64" stroke-dashoffset="64" d="M4 5h16c0.55 0 1 0.45 1 1v12c0 0.55 -0.45 1 -1 1h-16c-0.55 0 -1 -0.45 -1 -1v-12c0 -0.55 0.45 -1 1 -1Z"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s" values="64;0"/></path><path stroke-dasharray="24" stroke-dashoffset="24" d="M3 6.5l9 5.5l9 -5.5"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.6s" dur="0.2s" values="24;0"/></path></g></svg>'
                    label="Correo institucional" text="{{ $Persona->correo ?? '--' }}" id="Person_Correo" />

                <div class="row">
                    <div class="form-group col-6">

                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.5 4.5a1.5 1.5 0 0 1-3 0C10.5 3.672 12 2 12 2s1.5 1.672 1.5 2.5M12 6v3m5.667 5c1.564 0 2.833-1.12 2.833-2.5S19.232 9 17.667 9H6.333C4.77 9 3.5 10.12 3.5 11.5S4.769 14 6.333 14c1.371 0 2.571-.859 2.834-2c.262 1.141 1.462 2 2.833 2c1.37 0 2.57-.859 2.833-2c.263 1.141 1.463 2 2.834 2M5 14l.52 2.58c.525 2.597.788 3.895 1.676 4.658c.889.762 2.14.762 4.643.762h.322c2.503 0 3.754 0 4.643-.762c.889-.763 1.15-2.061 1.675-4.658L19 14" color="currentColor"/></svg>'
                            label="Fecha de nacimiento"
                            text="{{ \Carbon\Carbon::parse($Persona->fecha_nacimiento)->locale('es')->isoFormat('LL') }}"
                            id="Person_Birthday" />
                    </div>


                    <div class="form-group col-6">

                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20.75a1 1 0 0 0 1-1v-1.246c.004-2.806-3.974-5.004-8-5.004s-8 2.198-8 5.004v1.246a1 1 0 0 0 1 1zM15.604 6.854a3.604 3.604 0 1 1-7.208 0a3.604 3.604 0 0 1 7.208 0"/></svg>'
                            label="Edad" text="{{ $Persona->edad }} años" id="Person_edad" />
                    </div>
                </div>

                @php
                    $color = '';
                    switch ($Persona->estado->nombre) {
                        case 'Inactivo':
                            $color = '#dc2626';
                            break;

                        case 'De licencia':
                            $color = '#0B5ED7';
                            break;
                        case 'Incapacidad':
                            $color = '#eab308';
                            break;

                        default:
                            $color = '#373CC4';
                            break;
                    }

                @endphp
                <x-icon-cont
                    icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="{{ $color }}" fill-rule="evenodd" d="M18.98 9.253a7.52 7.52 0 0 0-4.233-4.234a3 3 0 0 0-.534.868a6.52 6.52 0 0 1 3.9 3.9a3 3 0 0 0 .868-.534m-6.752-3.75L12 5.5a6.5 6.5 0 1 0 6.496 6.272q.516-.162.976-.425q.027.323.028.653a7.5 7.5 0 1 1-6.847-7.472a5 5 0 0 0-.425.976" clip-rule="evenodd"/><circle cx="17" cy="7" r="3" fill="{{ $color }}"/></svg>'
                    label="Estatus laboral" text="{{ $Persona->estado->nombre }}" id="Person_Status" />
            </div>

            {{-- Contenedor del lado derecho  --}}

            <div class="col-12 col-md-6 col-xl-6">

                <div class="row pt-2">
                    <div class="form-group col-6">


                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 32 32"><path d="M10 9h2v2h-2z" fill="#373CC4"/><path d="M18 23h-4V9h4a4 4 0 0 1 4 4v6a4 4 0 0 1-4 4zm-2-2h2a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-2z" fill="#373CC4"/><path d="M10 13h2v10h-2z" fill="#373CC4"/></svg>'
                            label="RFC" text="{{ $Persona->honorario->rfc }} " id="Person_rfc" />

                    </div>
                    <div class="form-group col-6">


                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 22v-9.602c0-1.068 0-1.602.245-2.05c.244-.448.693-.737 1.592-1.315l2.082-1.338c.525-.337.787-.506 1.081-.506s.556.169 1.082.506l2.081 1.338c.899.578 1.348.867 1.592 1.315c.245.448.245.982.245 2.05V22m-5-9h.009M21 22v-5.838c0-2.291-1.26-2.477-4-3.162M3 22v-5.838C3 13.871 4.26 13.685 7 13m-5 9h20m-10 0v-4m0-11V4.982m0 0V2.97c0-.474 0-.711.146-.858c.46-.463 2.354.631 3.074 1.075c.608.374.78 1.122.78 1.795z" color="#373CC4"/></svg>'
                            label="Grado de estudios" text="{{ $Persona->ultimo_grado }} " id="Person_Grade" />

                    </div>
                </div>


                <div class="row pt-2">
                    <div class="form-group col-6">

                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 16 16"><path fill="#373CC4" d="M9.5 14h-8C.67 14 0 13.33 0 12.5V2.38C0 1.55.67.88 1.5.88h11c.83 0 1.5.67 1.5 1.5v7.25c0 .28-.22.5-.5.5s-.5-.22-.5-.5V2.38c0-.28-.22-.5-.5-.5h-11c-.28 0-.5.22-.5.5V12.5c0 .28.22.5.5.5h8c.28 0 .5.22.5.5s-.22.5-.5.5"/><path fill="#373CC4" d="M4 3.62c-.28 0-.5-.22-.5-.5V.5c0-.28.22-.5.5-.5s.5.22.5.5v2.62c0 .28-.22.5-.5.5m6.12 0c-.28 0-.5-.22-.5-.5V.5c0-.28.22-.5.5-.5s.5.22.5.5v2.62c0 .28-.22.5-.5.5M13.5 6H.5C.22 6 0 5.78 0 5.5S.22 5 .5 5h13c.28 0 .5.22.5.5s-.22.5-.5.5m-1 10C10.57 16 9 14.43 9 12.5S10.57 9 12.5 9s3.5 1.57 3.5 3.5s-1.57 3.5-3.5 3.5m0-6a2.5 2.5 0 0 0 0 5a2.5 2.5 0 0 0 0-5"/><path fill="#373CC4" d="M13.5 14a.47.47 0 0 1-.35-.15l-1-1a.5.5 0 0 1-.15-.35V11c0-.28.22-.5.5-.5s.5.22.5.5v1.29l.85.85c.2.2.2.51 0 .71c-.1.1-.23.15-.35.15"/></svg>'
                            label="F. de ingreso"
                            text="{{ \Carbon\Carbon::parse($Persona->fecha_ingreso)->locale('es')->isoFormat('LL') }}"
                            id="Person_Date" />

                    </div>
                    <div class="form-group col-6">

                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 512 512"><path fill="#373CC4" d="M115.063 21.97v9.343c0 101.953 38.158 189.648 96.343 222.093v6.094c-58.186 32.445-96.344 120.14-96.344 222.094v9.344H401.81v-9.344c0-102.552-38.804-190.274-97.53-222.188V253.5c58.722-31.917 97.53-119.64 97.53-222.188V21.97H115.06zM134 40.655h248.875c-2.477 96.445-42.742 175.523-91.938 198.906l-5.343 2.532v28.751l5.344 2.53c49.193 23.383 89.456 102.438 91.937 198.876H134c2.456-95.898 42.125-175.078 90.875-198.938l5.25-2.562v-28.594l-5.25-2.562c-48.748-23.86-88.42-103.04-90.875-198.938zm213.656 86.125c-57.607 27.81-124.526 27.84-177.562 4.095C184.748 181.78 213.91 218.012 248.22 224a12.18 12.18 0 0 0-2.47 7.344c0 6.76 5.488 12.25 12.25 12.25s12.25-5.49 12.25-12.25c0-2.72-.907-5.218-2.406-7.25c35.426-5.88 65.488-44.07 79.812-97.313zM258 258.626c-6.762 0-12.25 5.488-12.25 12.25s5.488 12.25 12.25 12.25s12.25-5.488 12.25-12.25s-5.488-12.25-12.25-12.25m0 39.28c-6.762 0-12.25 5.49-12.25 12.25c0 6.763 5.488 12.25 12.25 12.25s12.25-5.487 12.25-12.25c0-6.76-5.488-12.25-12.25-12.25m0 39.533c-6.762 0-12.25 5.488-12.25 12.25c0 6.76 5.488 12.25 12.25 12.25s12.25-5.49 12.25-12.25c0-6.762-5.488-12.25-12.25-12.25m.125 39.906c-23.21.28-46.19 25.77-75.813 75.656h153c-30.523-51.003-53.977-75.936-77.187-75.656"/></svg>'
                            label="Antigüedad" text="{{ $Persona->antiguedad }} años" id="Person_antigüedad" />

                    </div>
                </div>

                <p class="text-center mt-2 fw-normal"> Datos del contrato</p>

                <x-icon-cont
                    icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 56 56"><path fill="#0284c7" d="M28.012 28.023c5.578 0 10.125-4.968 10.125-11.015c0-6-4.5-10.711-10.125-10.711c-5.555 0-10.125 4.805-10.125 10.758c.023 6.023 4.57 10.968 10.125 10.968m0-3.539c-3.422 0-6.352-3.28-6.352-7.43c0-4.077 2.883-7.218 6.352-7.218c3.515 0 6.351 3.094 6.351 7.172c0 4.148-2.883 7.476-6.351 7.476m-14.719 25.22h29.438c3.89 0 5.742-1.173 5.742-3.75c0-6.142-7.735-15.024-20.461-15.024c-12.727 0-20.485 8.883-20.485 15.023c0 2.578 1.852 3.75 5.766 3.75m-1.125-3.54c-.61 0-.867-.164-.867-.656c0-3.844 5.953-11.04 16.71-11.04c10.759 0 16.688 7.196 16.688 11.04c0 .492-.234.656-.843.656Z"/></svg>'
                    label="Área asignada" text="{{ $Persona->honorario->area ?? '--' }}" id="area" />

                <div class="row">
                    <div class="form-group col-12">

                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48"><g fill="#0284c7"><path d="M18.5 24a3 3 0 1 1-6 0a3 3 0 0 1 6 0m14 3a3 3 0 1 0 0-6a3 3 0 0 0 0 6M31 29a3 3 0 0 0-3 3v2h9v-2a3 3 0 0 0-3-3zm-17 0a3 3 0 0 0-3 3v2h9v-2a3 3 0 0 0-3-3zm12-2.5a2 2 0 1 1-4 0a2 2 0 0 1 4 0M24 30a3 3 0 0 0-3 3v1h6v-1a3 3 0 0 0-3-3"/><path fill-rule="evenodd" d="M24.712 10.555L27.154 15H39a3 3 0 0 1 3 3v18a3 3 0 0 1-3 3H9a3 3 0 0 1-3-3V12a3 3 0 0 1 3-3h13.083a3 3 0 0 1 2.629 1.555M9 37a1 1 0 0 1-1-1V17h31a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1zm15.872-22l-1.913-3.482a1 1 0 0 0-.876-.518H9a1 1 0 0 0-1 1v3z" clip-rule="evenodd"/></g></svg>'
                            label="Parentesco" text="{{ $Persona->honorario->responsable ?? '--' }}"
                            id="responsible" />

                    </div>
                </div>

            </div>

            <!-- botones -->
            <div class="col-12 d-flex justify-content-end mt-2">
                @role('Administrador')
                    <div>
                        <abbr title="Editar los datos del nombramiento.">
                            <button id="botonEditar" class="btn fst-normal px-4 animated-icon button-edit"
                                data-bs-toggle="modal" data-bs-target="#modalEdit">
                                <i class="fa-solid fa-pen animated-icon px-1"></i> Editar
                            </button>
                        </abbr>
                    </div>
                @endrole
            </div>


        </div>
    </div>
</div>
