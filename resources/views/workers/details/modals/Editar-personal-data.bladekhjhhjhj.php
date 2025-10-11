<!-- Modal pata la edicion de los datos personales-->
<div class="modal fade " id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">
            <div class="modal-header bg-blue-primary d-flex justify-content-between">
                <h5 class="modal-title text-white" id="editModalLabel">Actualizar los datos personales</h5>
                <button class="btn fst-italic animated-icon button-white fs-5" data-bs-dismiss="modal"
                    id="cerrar_modal"> <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            
            <div class="modal-body w-custom-modal mt-0">
                <p class="mb-1 pb-0 fw-light"> Corrige los datos erróneos y, una vez verificados, haz clic en
                    <i>guardar</i>.
                </p>
                <!-- Alerta a editar el codigo  -->
                <div id="Alerta_err" class="p-0 m-0 d-none">
                    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between  p-0 m-0"
                        role="alert">
                        <p class="p-2  mb-1"> <strong>¡Error!</strong> El código que has ingresado ya pertenece a otra
                            persona.</p>
                        
                    </div>
                </div>
                <!-- Alerta -->
                <div id="Alerta_genero" class="p-0 m-0 d-none">
                    <div class="alert alert-warning alert-dismissible fade show d-flex justify-content-between  p-0 m-0"
                        role="alert">
                        <p class="p-2 mb-1"> <strong>Recuerda, </strong> También debes cambiar el género en los
                            nombramientos.</p>
                       
                    </div>
                </div>

                <div class="row mt-0 pt-1">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <x-input id="editCodigo" label="Código" name="editCodigo" value="{{ $persona->codigo }}"
                                     maxlength="7"  requiredIndicator="true" />
                               
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                @php
                                    $Generos = collect([
                                        ['id' => 1, 'nombre' => 'Masculino'],
                                        ['id' => 2, 'nombre' => 'Femenino'],
                                    ]);
                                    $generoSeleccionado = $Generos->firstWhere('nombre', $persona->sexo)['id'] ?? null;

                                @endphp

                                <x-select id="editGenero" label="Género" name="editGenero" :options="$Generos->pluck('nombre', 'id')->toArray()"
                                    selected="{{ $generoSeleccionado }}" requiredIndicator="true" />
                            </div>
                        </div>
                      
                        <x-input id="editNombre" label="Nombre" name="editNombre" value="{{ $persona->nombre }}"
                            uppercase="true" requiredIndicator="true" />

                        <x-input id="editCorreo" label="Correo" name="editCorreo" value="{{ $persona->correo }}" />

                        <div class="row pt-2">
                            <div class="form-group col-md-8 col-sm-8">

                                <x-input type="date" id="editFechaNacimiento" label="F. de nacimiento"
                                    name="editFechaNacimiento" value="{{ $persona->fecha_nacimiento }}"
                                    requiredIndicator="true" />

                            </div>
                            <div class="form-group col-md-4 col-sm-4 pt-2">
                                <label for="edad">Edad</label>
                                <div class="pt-1" id="modal_edad"> {{ $edad }} años</div>
                            </div>
                        </div>
                        <x-select id="editEstado" label="Estatus laboral" name="editEstado" :options="$estados->pluck('nombre', 'id')->toArray()"
                            selected="{{ $persona->estado_id }}" requiredIndicator="true" />
                    </div>
                    <!-- contenedor del lado derecho  -->
                    <div class="col-lg-6 col-md-6 col-sm-12">



                        <div class="form-group">
                            @php
                                // Mapear el grado
                                $grados = collect([
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
                                $gradoSeleccionado =
                                    $grados->firstWhere('nombre', $persona->ultimo_grado)['id'] ?? null;

                            @endphp

                            <x-select id="editGradoEstudio" label="Grado de estudios" name="editGradoEstudio"
                                :options="$grados->pluck('nombre', 'id')->toArray()" selected="{{ $gradoSeleccionado }}" requiredIndicator="true" />
                        </div>
                        <div class="form-group">
                            <div class="row pt-2">
                                <div class="form-group col-md-7 col-sm-8">
                                    <x-input type="date" id="editFechaIngreso" label="F. de ingreso"
                                        name="editFechaIngreso" value="{{ $persona->fecha_nacimiento }}"
                                        requiredIndicator="true" />
                                    
                                </div>
                                <div class="form-group col-md-5 col-sm-4 pt-2">
                                    <label for="antiguedad">Antiguedad</label>
                                    <div class="pt-1" id="modal_ant">{{ $Antiguedad }} años</div>
                                </div>
                            </div>
                        </div>
                        <p class="text-center pb-0 mt-4 mb-0 text-muted"> Información del contacto de emergencia</p>

                        <x-input id="editNombreEmer" label="Nombre" name="editNombreEmer"
                            value="{{ $persona->nombre_emergencia ?? '--' }}" />

                        <div class="row mt-0">
                            <div class="form-group col-md-6 col-sm-12">

                                <x-input id="editParentEmer" label="Parentesco" name="editParentEmer"
                                    value="{{ $persona->e_parentesco ?? '--' }}" />

                            </div>
                           
                            <div class="form-group col-md-6 col-sm-12">
                                <x-input id="editTelEmer" label="Teléfono" name="editTelEmer"
                                    value="{{ $persona->tel_emergencia ?? '--' }}" maxlength="10" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn fst-italic animated-icon button-cancel" data-bs-dismiss="modal"> <i
                        class="fa-solid fa-xmark"></i> Cerrar
                </button>

                <button class="btn fst-italic animated-icon button-save" id="confirm-edit"
                    data-id="{{ $id }}"> <i class="fa-solid fa-check"></i> Guarda
                </button>
            </div>
        </div>
    </div>
</div>
