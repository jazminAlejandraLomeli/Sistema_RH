<div class="card">
    <h5 class="card-header bg-blue-primary text-white text-center">Datos personales</h5>
    <div class="card-body Personal-Data">
        <p class="pt-1 mb-0">Escribe los datos correspondientes para agregar nuevo trabajador al sistema.</p>

        <div class="row ">
            <div class="col-12 col-md-6 col-xl-6 mt-1">
                <div class="row">
                    <div class="col-6 col-sm-12">
                        <x-input id="codigo" label="Código" name="codigo" requiredIndicator="true" maxlength="7" />

                    </div>
                    <div class="col-6 col-sm-12">
                        @php
                            // Mapear el grado
                            $sexo = collect([['id' => 1, 'nombre' => 'Maculino'], ['id' => 2, 'nombre' => 'Femenino']]);

                        @endphp


                        <x-select id="sex" label="Género" name="sex"   :options="['' => 'Selecciona un género'] +$sexo->pluck('nombre', 'id')->toArray()"
                            requiredIndicator="true" />

                    </div>
                </div>
                <x-input id="name_P" label="Nombre completo" name="name_P" requiredIndicator="true"  />

                <x-input id="correo" label="Correo" name="correo" />

                <x-input id="fecha_nacimiento" label="F. de nacimiento" name="fecha_nacimiento" requiredIndicator="true"
                    type="date" />

            </div>
            <div class="col-12 col-md-6 col-xl-6 mt-1">



                <x-input id="fecha_ingreso" label="F. de ingreso a UDG" name="fecha_ingreso" requiredIndicator="true"
                    type="date" />

                @php
                    // Mapear el grado
                    $grado = collect([
                        ['id' => 1, 'nombre' => 'Primaria'],
                        ['id' => 2, 'nombre' => 'Secundaria'],
                        ['id' => 3, 'nombre' => 'Bachillerato'],
                        ['id' => 4, 'nombre' => 'Carrera técnica'],
                        ['id' => 5, 'nombre' => 'Licenciatura/Ingeniería'],
                        ['id' => 6, 'nombre' => 'Especialidad'],
                        ['id' => 7, 'nombre' => 'Maestría'],
                        ['id' => 8, 'nombre' => 'Doctorado'],
                        ['id' => 9, 'nombre' => 'Sin estudios'],
                    ]);

                @endphp

                <x-select id="grade" label="Grado de estudios" name="grade"   :options="['' => 'Selecciona un grado'] +$grado->pluck('nombre', 'id')->toArray()"
                    requiredIndicator="true" />
                <hr class="mt-3">
                <p class="text-center"> Información de contacto de emergencia </p>

                <x-input id="Emer_name" label="Nombre" name="Emer_name" />

                <div class="row">
                    <div class="col-6">

                        <x-input id="parentesco" label="Parentesco" name="parentesco" />
                    </div>
                    <div class="col-6">
                        <x-input id="tel" label="Teléfono" name="tel" maxlength="10" />
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 d-lg-flex justify-content-lg-end mt-3">
            <div class="d-flex flex-column flex-lg-row gap-3">
                <a class="btn fst-italic  animated-icon button-cancel back"> <i class="pe-2 fa-solid fa-xmark"></i>
                    Cancelar</a>


                <button class="btn fst-italic  animated-icon  button-save" id="personal-data"> Siguiente <i
                        class="ps-2 fa-solid fa-arrow-right"></i></button>
            </div>


        </div>
    </div>
</div>