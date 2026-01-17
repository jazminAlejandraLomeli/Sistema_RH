<div class="card">
    <h5 class="card-header bg-blue-primary text-white text-center">Actualizar datos personales</h5>
    <div class="card-body Personal-Data">
        {{-- <p class="pt-1 mb-0">Escribe los datos correspondientes para agregar nuevo trabajador al sistema.</p> --}}

        <div class="row ">
            <p> Actualiza los datos que hyan cambiado o que no sea correctos y da clic en <b> Guardar</b>.</p>

            <div class="col-12 col-md-6 col-xl-6 mt-1">

                <x-section-divider text="Datos personales" color="#0284c7" />

                <div class="row">
                    <div class="col-12 col-md-6 col-xl-6">
                        <x-input id="codigo" label="Código" name="codigo" requiredIndicator="true" maxlength="7"
                            placeolder="1234567" value="{{ $worker->codigo }}" />

                    </div>

                    <div class="col-12 col-md-6 col-xl-6">
                        @php
                            $sexo = collect(config('collections.sexo'));
                        @endphp

                        <x-select id="sex" label="Género" name="sex" :options="['' => 'Género'] + $sexo->pluck('nombre', 'id')->toArray()"
                            requiredIndicator="true" selected="{{ $worker->sexo }}" />

                    </div>
                </div>

                <x-input id="name_P" label="Nombre completo" name="name_P" requiredIndicator="true" uppercase="true"
                    placeolder='LÓPEZ LÓPEZ SAMMUEL' value="{{ $worker->nombre }}" />


                <div class="row">
                    <div class="col-12 col-md-6 col-xl-6">
                        <x-input id="fecha_nacimiento" label="F. de nacimiento" name="fecha_nacimiento"
                            requiredIndicator="true" type="date" value="{{ $worker->fecha_nacimiento }}" />
                    </div>
                    <div class="col-12 col-md-6 col-xl-6">
                        <x-input id="fecha_ingreso" label="F. de ingreso a UDG" name="fecha_ingreso"
                            requiredIndicator="true" type="date" value="{{ $worker->fecha_ingreso }}" />
                    </div>
                </div>


                <div class="row">


                    <div class="col-12 col-md-6 col-xl-6">
                        @php
                            $grado = collect(config('collections.grados'));
                        @endphp

                        <x-select id="grade" label="Grado de estudios" name="grade" :options="['' => 'Selecciona un grado'] + $grado->pluck('nombre', 'id')->toArray()"
                            requiredIndicator="true" selected="{{ $worker->ultimo_grado }}" />
                    </div>


                    <div class="col-12 col-md-6 col-xl-6">

                        <x-input id="telefono" label="Teléfono" name="telefono" maxlength="10"
                            value="{{ $worker->telefono }}" />
                    </div>

                </div>

                <x-input id="correo" label="Correo" name="correo" value="{{ $worker->correo }}" />

            </div>


            <div class="col-12 col-md-6 col-xl-6 mt-1  ">
                <div class="delete-pt">

                    <div class="row">
                        <div class="col-12 col-md-6 col-xl-6">
                            <x-input id="nss" label="NSS" name="nss" maxlength="11"
                                value="{{ $worker->nss }}" />
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <x-input id="rfc" label="RFC" name="rfc" maxlength="13"
                                value="{{ $worker->rfc }}" />
                        </div>
                    </div>
                </div>

                <div class="row pb-4">
                    <div class="col-12 col-md-6 col-xl-6">
                        <x-select id="status" label="Estado laboral" name="status" :options="['' => 'Selecciona un estado'] + $estados->pluck('nombre', 'id')->toArray()"
                            selected="{{ $worker->estado_id ?? '' }}" />
                    </div>
                </div>

                <x-section-divider text="Contacto de emergencia" color="#e11d48" />

                <x-input id="Emer_name" label="Nombre del contacto" name="Emer_name"
                    placeolder="Ana Sofía Pérez Arellano" value="{{ $worker->nombre_emergencia ?? '' }}" />

                <div class="row">
                    <div class="col-6">

                        <x-input id="parentesco" label="Parentesco" name="parentesco" placeolder="Hermana"
                            value="{{ $worker->e_parentesco ?? '' }}" />
                    </div>
                    <div class="col-6">
                        <x-input id="tel_emer" label="Teléfono" name="tel_emer" maxlength="10"
                            placeolder="5512345678" value="{{ $worker->tel_emergencia ?? '' }}" />
                    </div>
                </div>
            </div>
        </div>

        {{-- Botones --}}
        <hr class="border border-primary border-2 opacity-50">
        @include('workers.details.update.partials.persona-buttons')

    </div>
</div>
