<div class="row mt-3 mb-4 card animate__animated animate__fadeInDown p-3 mw-75 mx-auto">

    <x-section-divider text="Datos personales" color="#0284c7" />

    <div class="row mt-3 px-0 ">

        <div class="col-12 col-md-6 col-xl-6">

            <x-icon-cont
                icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20.75a1 1 0 0 0 1-1v-1.246c.004-2.806-3.974-5.004-8-5.004s-8 2.198-8 5.004v1.246a1 1 0 0 0 1 1zM15.604 6.854a3.604 3.604 0 1 1-7.208 0a3.604 3.604 0 0 1 7.208 0"/></svg>'
                label="Nombre Completo" text="{{ $Worker->nombre }}" id="Person_Name" />

            <div class="row">
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
                        label="Código" text="{{ $Worker->codigo }}" id="Person_Code" />
                </div>
                <div class="form-group col-6">
                    @if ($Worker->sexo == 'Femenino')
                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#c026d3" d="M12 4a6 6 0 0 1 6 6c0 2.97-2.16 5.44-5 5.92V18h2v2h-2v2h-2v-2H9v-2h2v-2.08c-2.84-.48-5-2.95-5-5.92a6 6 0 0 1 6-6m0 2a4 4 0 0 0-4 4a4 4 0 0 0 4 4a4 4 0 0 0 4-4a4 4 0 0 0-4-4"/></svg>'
                            label="Género" text="{{ $Worker->sexo }}" id="Person_sex" />
                    @else
                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#4f46e5" d="M9 9c1.29 0 2.5.41 3.47 1.11L17.58 5H13V3h8v8h-2V6.41l-5.11 5.09c.7 1 1.11 2.2 1.11 3.5a6 6 0 0 1-6 6a6 6 0 0 1-6-6a6 6 0 0 1 6-6m0 2a4 4 0 0 0-4 4a4 4 0 0 0 4 4a4 4 0 0 0 4-4a4 4 0 0 0-4-4"/></svg>'
                            label="Género" text="{{ $Worker->sexo }}" id="Person_sex" />
                    @endif


                </div>
            </div>

            <x-icon-cont
                icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 14 14"><g fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round"><path d="M1.634 12.41a1.007 1.007 0 1 0 0-2.014a1.007 1.007 0 0 0 0 2.013m0-2.013V5.732m8.761 1.084q.014.288.014.578c0 .484-.033.96-.079 1.427c-.095.981-.878 1.774-1.839 1.873c-.487.05-.985.087-1.491.087s-1.005-.038-1.492-.088c-.961-.098-1.744-.89-1.84-1.872a15 15 0 0 1-.078-1.427q0-.29.015-.578"/><path d="M1.008 4.23C.5 4.548.5 5.006 1.006 5.325c.7.443 1.425.903 2.266 1.324c.842.422 1.76.784 2.644 1.135c.638.254 1.551.254 2.188 0c.877-.351 1.786-.715 2.623-1.135s1.564-.874 2.264-1.314c.508-.318.508-.776.002-1.095c-.7-.443-1.424-.903-2.266-1.324c-.841-.422-1.76-.784-2.643-1.135c-.639-.254-1.552-.254-2.188 0c-.878.351-1.786.715-2.624 1.135c-.837.42-1.564.874-2.264 1.314"/></g></svg>'
                label="Grado de estudios" text="{{ $Worker->ultimo_grado }} " id="Person_Grade" />


            <div class="row d-flex align-items-center">
                <div class="form-group col-8">

                    <x-icon-cont
                        icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.5 4.5a1.5 1.5 0 0 1-3 0C10.5 3.672 12 2 12 2s1.5 1.672 1.5 2.5M12 6v3m5.667 5c1.564 0 2.833-1.12 2.833-2.5S19.232 9 17.667 9H6.333C4.77 9 3.5 10.12 3.5 11.5S4.769 14 6.333 14c1.371 0 2.571-.859 2.834-2c.262 1.141 1.462 2 2.833 2c1.37 0 2.57-.859 2.833-2c.263 1.141 1.463 2 2.834 2M5 14l.52 2.58c.525 2.597.788 3.895 1.676 4.658c.889.762 2.14.762 4.643.762h.322c2.503 0 3.754 0 4.643-.762c.889-.763 1.15-2.061 1.675-4.658L19 14" color="currentColor"/></svg>'
                        label="Fecha de nacimiento"
                        text="{{ \Carbon\Carbon::parse($Worker->fecha_nacimiento)->locale('es')->isoFormat('LL') }}"
                        id="Person_Birthday" />
                </div>


                <div class="form-group col-4">
                    @php
                        $edad = \Carbon\Carbon::parse($Worker->fecha_nacimiento);
                    @endphp
                    <span> <b>{{ $edad->age }}</b> años</span>
                    {{-- <x-icon-cont
                        icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20.75a1 1 0 0 0 1-1v-1.246c.004-2.806-3.974-5.004-8-5.004s-8 2.198-8 5.004v1.246a1 1 0 0 0 1 1zM15.604 6.854a3.604 3.604 0 1 1-7.208 0a3.604 3.604 0 0 1 7.208 0"/></svg>'
                        label="Edad" text="{{ $edad->age }} años" id="Person_edad" /> --}}
                </div>
            </div>


            <x-icon-cont
                icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><g fill="none" stroke="#0284c7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path stroke-dasharray="64" stroke-dashoffset="64" d="M4 5h16c0.55 0 1 0.45 1 1v12c0 0.55 -0.45 1 -1 1h-16c-0.55 0 -1 -0.45 -1 -1v-12c0 -0.55 0.45 -1 1 -1Z"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s" values="64;0"/></path><path stroke-dasharray="24" stroke-dashoffset="24" d="M3 6.5l9 5.5l9 -5.5"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.6s" dur="0.2s" values="24;0"/></path></g></svg>'
                label="Correo institucional" text="{{ $Worker->correo ?? '--' }}" id="Person_Correo" />

            <div class="row d-flex align-items-center">
                <div class="form-group col-6">
                    <x-icon-cont
                        icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#0284c7" d="M19.5 22a1.5 1.5 0 0 0 1.5-1.5V17a1.5 1.5 0 0 0-1.5-1.5c-1.17 0-2.32-.18-3.42-.55a1.51 1.51 0 0 0-1.52.37l-1.44 1.44a14.77 14.77 0 0 1-5.89-5.89l1.43-1.43c.41-.39.56-.97.38-1.53c-.36-1.09-.54-2.24-.54-3.41A1.5 1.5 0 0 0 7 3H3.5A1.5 1.5 0 0 0 2 4.5C2 14.15 9.85 22 19.5 22M3.5 4H7a.5.5 0 0 1 .5.5c0 1.28.2 2.53.59 3.72c.05.14.04.34-.12.5L6 10.68c1.65 3.23 4.07 5.65 7.31 7.32l1.95-1.97c.14-.14.33-.18.51-.13c1.2.4 2.45.6 3.73.6a.5.5 0 0 1 .5.5v3.5a.5.5 0 0 1-.5.5C10.4 21 3 13.6 3 4.5a.5.5 0 0 1 .5-.5"/></svg>'
                        label="Teléfono" text="{{ $Worker->telefono ?? '--' }} " id="phone" />

                </div>
                <div class="form-group col-6">
                    @php
                        $color = '';
                        switch ($Worker->estado->nombre) {
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
                        label="Estado" text="{{ $Worker->estado->nombre }}" id="Person_Status" />

                </div>
            </div>

        </div>
        {{-- contenedor de la derecha  --}}
        <div class="col-12 col-md-6 col-xl-6">

            <div class="row d-flex align-items-center">
                <div class="form-group col-8">

                    <x-icon-cont
                        icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 16 16"><path fill="#373CC4" d="M9.5 14h-8C.67 14 0 13.33 0 12.5V2.38C0 1.55.67.88 1.5.88h11c.83 0 1.5.67 1.5 1.5v7.25c0 .28-.22.5-.5.5s-.5-.22-.5-.5V2.38c0-.28-.22-.5-.5-.5h-11c-.28 0-.5.22-.5.5V12.5c0 .28.22.5.5.5h8c.28 0 .5.22.5.5s-.22.5-.5.5"/><path fill="#373CC4" d="M4 3.62c-.28 0-.5-.22-.5-.5V.5c0-.28.22-.5.5-.5s.5.22.5.5v2.62c0 .28-.22.5-.5.5m6.12 0c-.28 0-.5-.22-.5-.5V.5c0-.28.22-.5.5-.5s.5.22.5.5v2.62c0 .28-.22.5-.5.5M13.5 6H.5C.22 6 0 5.78 0 5.5S.22 5 .5 5h13c.28 0 .5.22.5.5s-.22.5-.5.5m-1 10C10.57 16 9 14.43 9 12.5S10.57 9 12.5 9s3.5 1.57 3.5 3.5s-1.57 3.5-3.5 3.5m0-6a2.5 2.5 0 0 0 0 5a2.5 2.5 0 0 0 0-5"/><path fill="#373CC4" d="M13.5 14a.47.47 0 0 1-.35-.15l-1-1a.5.5 0 0 1-.15-.35V11c0-.28.22-.5.5-.5s.5.22.5.5v1.29l.85.85c.2.2.2.51 0 .71c-.1.1-.23.15-.35.15"/></svg>'
                        label="F. de ingreso"
                        text="{{ \Carbon\Carbon::parse($Worker->fecha_ingreso)->locale('es')->isoFormat('LL') }}"
                        id="Person_Date" />
                </div>


                <div class="form-group col-4">
                    @php
                        $antigueada = \Carbon\Carbon::parse($Worker->fecha_ingreso);
                    @endphp
                    <span> <b>{{ $antigueada->age }}</b> años</span>

                </div>
            </div>



            <div class="row">
                <div class="form-group col-6">
                    <x-icon-cont
                        icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="none" stroke="#373CC4" stroke-linejoin="round" stroke-width="1.5" d="M21 6.75a3.75 3.75 0 1 0-7.5 0a3.75 3.75 0 0 0 7.5 0Zm-10.5 0a3.75 3.75 0 1 0-7.5 0a3.75 3.75 0 0 0 7.5 0ZM21 17.25a3.75 3.75 0 1 0-7.5 0a3.75 3.75 0 0 0 7.5 0Zm-10.5 0a3.75 3.75 0 1 0-7.5 0a3.75 3.75 0 0 0 7.5 0Z"/></svg>'
                        label="RFC" text="{{ $Worker->rfc ?? '--' }}" id="Person_Code" />
                </div>
                <div class="form-group col-6">
                    <x-icon-cont
                        icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48"><path fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round" d="M16.951 17.884c2.45-.749 7.004-2.796 12.813-8.199c8.383-7.794 12.667-3.55 12.735 3.9s-3.838 23.28-7.495 26.394s-7.018 2.427-7.018 2.427s5.999-3.421 2.745-11.51s-11.802-11.138-16.711-11.2s-7.452-.282-7.877.654c0 0-1.314-1.48-.183-2.196s2.544-1.24 3.117-1.994s3.534-1.443 7.042-1.309s4.406-.313 4.406-.313"/><path fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round" d="M21.698 12.646a53 53 0 0 1-3.462-2.96C9.853 1.89 5.569 6.135 5.5 13.584c-.006.66.019 1.383.072 2.159m.995 7.136c1.402 7.175 3.971 15.007 6.428 17.1c3.657 3.115 7.018 2.427 7.018 2.427m14.082-8.726a25.7 25.7 0 0 0-3.91-10.428c-3.13-4.594-3.855-5.515-2.963-7.255s4.696-4.355 4.696-4.355"/><path fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round" d="M21.783 30.25s-3.296.895-3.799-1.485s1.369-3.948 4.211-2.854s5.865 8.261 3.404 12.112s-8.832.285-8.832.285"/><path fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round" d="M21.528 36.734c.73-.632-.023-2.228-1.226-1.973c-.111-1-1.454-1.88-3.389-.847c-2.263 1.21-1.232 4.94 2.661 4.247M17.7 31.72a3.7 3.7 0 0 1 2.215-1.337"/></svg>'
                        label="NSS" text="{{ $Worker->nss ?? '--' }}" id="Person_Correo" />
                </div>
            </div>


            <x-section-divider text="Contacto de emergencia" color="#A72703" />

            <x-icon-cont
                icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 56 56"><path fill="#0284c7" d="M28.012 28.023c5.578 0 10.125-4.968 10.125-11.015c0-6-4.5-10.711-10.125-10.711c-5.555 0-10.125 4.805-10.125 10.758c.023 6.023 4.57 10.968 10.125 10.968m0-3.539c-3.422 0-6.352-3.28-6.352-7.43c0-4.077 2.883-7.218 6.352-7.218c3.515 0 6.351 3.094 6.351 7.172c0 4.148-2.883 7.476-6.351 7.476m-14.719 25.22h29.438c3.89 0 5.742-1.173 5.742-3.75c0-6.142-7.735-15.024-20.461-15.024c-12.727 0-20.485 8.883-20.485 15.023c0 2.578 1.852 3.75 5.766 3.75m-1.125-3.54c-.61 0-.867-.164-.867-.656c0-3.844 5.953-11.04 16.71-11.04c10.759 0 16.688 7.196 16.688 11.04c0 .492-.234.656-.843.656Z"/></svg>'
                label="Nombre" text="{{ $Worker->nombre_emergencia ?? '--' }}" id="name_emer" />

            <div class="row">
                <div class="form-group col-6">

                    <x-icon-cont
                        icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48"><g fill="#0284c7"><path d="M18.5 24a3 3 0 1 1-6 0a3 3 0 0 1 6 0m14 3a3 3 0 1 0 0-6a3 3 0 0 0 0 6M31 29a3 3 0 0 0-3 3v2h9v-2a3 3 0 0 0-3-3zm-17 0a3 3 0 0 0-3 3v2h9v-2a3 3 0 0 0-3-3zm12-2.5a2 2 0 1 1-4 0a2 2 0 0 1 4 0M24 30a3 3 0 0 0-3 3v1h6v-1a3 3 0 0 0-3-3"/><path fill-rule="evenodd" d="M24.712 10.555L27.154 15H39a3 3 0 0 1 3 3v18a3 3 0 0 1-3 3H9a3 3 0 0 1-3-3V12a3 3 0 0 1 3-3h13.083a3 3 0 0 1 2.629 1.555M9 37a1 1 0 0 1-1-1V17h31a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1zm15.872-22l-1.913-3.482a1 1 0 0 0-.876-.518H9a1 1 0 0 0-1 1v3z" clip-rule="evenodd"/></g></svg>'
                        label="Parentesco" text="{{ $Worker->e_parentesco ?? '--' }}" id="parentesco_emer" />

                </div>
                <div class="form-group col-6">

                    <x-icon-cont
                        icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="none" stroke="#0284c7" stroke-dasharray="64" stroke-dashoffset="64" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 3c0.5 0 2.5 4.5 2.5 5c0 1 -1.5 2 -2 3c-0.5 1 0.5 2 1.5 3c0.39 0.39 2 2 3 1.5c1 -0.5 2 -2 3 -2c0.5 0 5 2 5 2.5c0 2 -1.5 3.5 -3 4c-1.5 0.5 -2.5 0.5 -4.5 0c-2 -0.5 -3.5 -1 -6 -3.5c-2.5 -2.5 -3 -4 -3.5 -6c-0.5 -2 -0.5 -3 0 -4.5c0.5 -1.5 2 -3 4 -3Z"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s" values="64;0"/></path></svg>'
                        label="Teléfono" text="{{ $Worker->tel_emergencia ?? '--' }}" id="Person_Telf" />
                </div>
            </div>



        </div>

        <div class="col-12 d-lg-flex justify-content-end mt-3 ">

             <div class="d-flex flex-column flex-lg-row gap-3">

                <div class="flex-fill flex-lg-grow-0" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="Ver detalles de datos personales">
                    <x-save-button-component text="Editar" description="Ver detalles y editar datos"
                        href="{{ route('worker.detalles.edit-personal', $Worker->id) }}" />
                </div>

            </div>
        </div>

    </div>


</div>
