<div class="card">
    <h5 class="card-header bg-blue-primary text-white text-center">Formulario de registro de personal</h5>
    <div class="card-body Personal-Data">
        {{-- <p class="pt-1 mb-0">Escribe los datos correspondientes para agregar nuevo trabajador al sistema.</p> --}}

        <div class="row ">
            <p> El <span class="text-danger fw-bold"> * </span> indica que el campo es obligatorio.</p>

            <div class="col-12 col-md-6 col-xl-6 mt-1">

                <x-section-divider text="Datos personales" color="#0284c7" />

                <div class="row">
                    <div class="col-12 col-md-6 col-xl-6">
                        <x-input id="codigo" label="Código" name="codigo" requiredIndicator="true" maxlength="7"
                            placeolder="1234567" />

                    </div>
                    <div class="col-12 col-md-6 col-xl-6">
                        @php
                            $sexo = collect(config('collections.sexo'));
                        @endphp

                        <x-select id="sex" label="Género" name="sex" :options="['' => 'Género'] + $sexo->pluck('nombre', 'id')->toArray()"
                            requiredIndicator="true" />

                    </div>
                </div>

                <x-input id="name_P" label="Nombre completo" name="name_P" requiredIndicator="true" uppercase="true"
                    placeolder='LÓPEZ LÓPEZ SAMMUEL' />


                <div class="row">
                    <div class="col-12 col-md-6 col-xl-6">
                        <x-input id="fecha_nacimiento" label="F. de nacimiento" name="fecha_nacimiento"
                            requiredIndicator="true" type="date" />
                    </div>
                    <div class="col-12 col-md-6 col-xl-6">
                        <x-input id="fecha_ingreso" label="F. de ingreso a UDG" name="fecha_ingreso"
                            requiredIndicator="true" type="date" />
                    </div>
                </div>


                <div class="row">


                    <div class="col-12 col-md-6 col-xl-6">
                        @php
                            $grado = collect(config('collections.grados'));
                        @endphp

                        <x-select id="grade" label="Grado de estudios" name="grade" :options="['' => 'Selecciona un grado'] + $grado->pluck('nombre', 'id')->toArray()"
                            requiredIndicator="true" />
                    </div>


                    <div class="col-12 col-md-6 col-xl-6">

                        <x-input id="telefono" label="Teléfono" name="telefono" maxlength="10" />
                    </div>


                </div>
                <x-input id="correo" label="Correo" name="correo" />

                <div class="row">
                    <div class="col-12 col-md-6 col-xl-6">
                        <x-input id="nss" label="NSS" name="nss" maxlength="11" />
                    </div>
                    <div class="col-12 col-md-6 col-xl-6">
                        <x-input id="rfc" label="RFC" name="rfc" maxlength="13" />
                    </div>
                </div>

            </div>

            {{-- Contenedor dos --}}
            <div class="col-12 col-md-6 col-xl-6 mt-3 mt-md-1">


                <x-section-divider text="Datos del domicilio" color="#65a30d" />

                @php
                    $states = collect(config('collections.estados'));
                @endphp

                <x-select id="state" label="Estado" name="state" :options="['' => 'Selecciona un estado'] + $states->pluck('nombre', 'id')->toArray()" />

                <x-input id="city" label="Ciudad" name="city" placeolder="Tepatitlán de Morelos" />


                <x-input id="calle" label="Calle" name="calle" placeolder="Av. López López" />




                <div class="row">
                    <div class="col-12 col-md-6 col-xl-6">
                        <x-input id="colonia" label="Colonia" name="colonia" placeolder="Las colonias" />


                    </div>
                    <div class="col-12 col-md-6 col-xl-6">
                        <x-input id="cp" label="Código Postal" name="cp" placeolder='47600'
                            maxlength="5" />

                    </div>
                </div>

                <div class="row">

                    <div class="col-12 col-md-6 col-xl-6">
                        <x-input id="numero" label="Número" name="numero" placeolder='55 A' maxlength="10"/>

                    </div>
                </div>





            </div>

            <div class="row m-0">
                <div class="mt-4">
                    <x-section-divider text="Contacto de emergencia" color="#e11d48" />

                    <x-input id="Emer_name" label="Nombre del contacto" name="Emer_name"
                        placeolder="Ana Sofía Pérez Arellano" />

                    <div class="row">
                        <div class="col-6">

                            <x-input id="parentesco" label="Parentesco" name="parentesco" placeolder="Hermana" />
                        </div>
                        <div class="col-6">
                            <x-input id="tel_emer" label="Teléfono" name="tel_emer" maxlength="10"
                                placeolder="5512345678" />
                        </div>
                    </div>
                </div>
            </div>
             <input type="hidden" name="status" id="status" value="1">

        </div>


        {{-- Botones --}}
        <hr class="border border-primary border-2 opacity-50">
        @include('workers.new-worker.partials.buttons-personal')
 

    </div>
</div>
 