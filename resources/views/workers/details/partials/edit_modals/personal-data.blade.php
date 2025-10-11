<!-- Modal pata la edicion de los datos personales-->
<div class="modal fade " id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">
            <div class="modal-header  bg-blue-primary justify-content-between">
                <h5 class="modal-title text-white" id="editModalLabel">Datos personales</h5>
                <button class="btn fst-italic animated-icon button-white cancel" data-bs-dismiss="modal"
                    id="cerrar_modal"> <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0 pb-0 fw-light"> Corrige los datos erróneos y, una vez verificados, haz clic en
                    <i>guardar</i>.
                </p>
                <!-- Alerta a editar el codigo  -->
                <div id="Alerta_err" class="p-0 m-0 d-none">
                    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between  p-0 m-0"
                        role="alert">
                        <p class="p-2  mb-1"> <strong>¡Error!</strong> El código que has ingresado ya pertenece a otra
                            persona.</p>
                        <button class="btn fst-italic animated-icon button-cancel mb-1 rigth-0" data-dismiss="alert">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
                <!-- Alerta -->
                <div id="Alerta_genero" class="p-0 m-0 d-none">
                    <div class="alert alert-warning alert-dismissible fade show d-flex justify-content-between  p-0 m-0"
                        role="alert">
                        <p class="p-2 mb-1"> <strong>Recuerda, </strong> También debes cambiar el género en los
                            nombramientos.</p>
                        <button class="btn fst-italic animated-icon button-cancel mb-1 rigth-0" data-dismiss="alert">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>




                <div class="row  mt-2">

                    <div class="col-12 col-md-6 col-xl-6">

                        <div class="row">
                            <div class="col-6">
                                <x-input id="editCodigo" label="Código" name="editCodigo" value="{{ $persona->codigo }}"
                                    requiredIndicator="true" maxlength="9" />

                            </div>
                            <div class="col-6">
                                @php
                                    // Mapear el grado
                                    $sexo = collect([
                                        ['id' => 1, 'nombre' => 'Maculino'],
                                        ['id' => 2, 'nombre' => 'Femenino'],
                                    ]);

                                    $Sexo_seleccionado = $sexo->firstWhere('nombre', $persona->sexo)['id'] ?? null;

                                @endphp


                                <x-select id="editGenero" label="Género" name="editGenero" :options="$sexo->pluck('nombre', 'id')->toArray()"
                                    selected="{{ $Sexo_seleccionado }}" requiredIndicator="true" />

                            </div>
                        </div>

                        <x-input id="editNombre" label="Nombre" name="editNombre"
                            value="{{ old('editNombre', $persona->nombre) }}" requiredIndicator="true" />

                        <x-input id="editCorreo" label="Correo" name="editCorreo"
                            value="{{ $persona->correo ?? '--' }}" />


                        <div class="row">
                            <div class="col-8">
                                <x-input id="editFechaNacimiento" type="date" label="F. de nacimiento"
                                    name="editFechaNacimiento" type="date" value="{{ $persona->fecha_nacimiento }}"
                                    requiredIndicator="true" />
                            </div>
                            <div class="col-4 mt-2">
                                <label for="edad">Edad</label>
                                <div class="pt-1" id="modal_edad"> {{ $edad }} años</div>
                            </div>
                        </div>
                        

                        <x-select id="editEstado" label="Estatus laboral" name="editEstado" :options="$estados->pluck('nombre', 'id')->toArray()"
                            selected="{{ $persona->estado_id }}" requiredIndicator="true" />

                    </div>

                    <div class="col-12 col-md-6 col-xl-6">
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

                            $Grado_seleccionado = $grado->firstWhere('nombre', $persona->ultimo_grado)['id'] ?? null;

                        @endphp

                        <x-select id="editGradoEstudio" label="Grado de estudios" name="editGradoEstudio"
                            :options="$grado->pluck('nombre', 'id')->toArray()" selected="{{ $Grado_seleccionado }}" requiredIndicator="true" />

                        <div class="row">
                            <div class="col-8">
                                <x-input id="editFechaIngreso" type="date" label="Fecha de ingreso"
                                    name="editFechaIngreso" type="date" value="{{ $persona->fecha_ingreso }}"
                                    requiredIndicator="true" />
                            </div>
                            <div class="col-4 mt-2">
                                <label for="modal_ant">Antigüedad</label>
                                <div class="pt-1" id="modal_ant"> {{ $Antiguedad }} años</div>
                            </div>
                        </div>

                        <p class="mt-4 mb-0 text-center"> <i> Contacto de emergencia </i></p>

                        <x-input id="editNombreEmer" label="Nombre" name="editNombreEmer"
                            value="{{ $persona->nombre_emergencia ?? '--' }}" />


                        <div class="row">
                            <div class="col-6">

                                <x-input id="editParentEmer" label="Parentesco" name="editParentEmer" value="{{$persona->e_parentesco ?? '--'}}" />
                            </div>
                            <div class="col-6">
                                <x-input id="editTelEmer" label="Teléfono" name="editTelEmer" value="{{ $persona->tel_emergencia ?? '--' }}"  maxlength="10" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn fst-italic animated-icon button-cancel" data-bs-dismiss="modal"> <i
                        class="fa-solid fa-xmark"></i> Cerrar </button>
                <button class="btn fst-italic animated-icon button-save" id="confirm-edit"
                    data-id="{{ $id }}"> <i class="fa-solid fa-check"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>

