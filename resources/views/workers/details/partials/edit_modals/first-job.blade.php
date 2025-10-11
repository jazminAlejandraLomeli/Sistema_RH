{{-- Modal para la edicion delos datos del nombramiento principal  --}}
<div class="modal fade" id="Editprincipal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue-primary d-felx justify-content-between">
                <h5 class="modal-title text-white" id="modalDetallesNombramientoLabel">Actualizar nombramiento Principal
                </h5>
                <button class="btn fst-italic animated-icon button-white cancel" data-bs-dismiss="modal"
                    id="cerrar_modal"> <i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="col-12 content-custom">
                    <p class="mb-0 pb-0 fw-light"> Corrige los datos erróneos y, una vez verificados, haz clic en
                        <i>guardar</i>.
                    </p>

                    <div class="row">
                        <div class="col-6">
                            <x-select id="ENombramiento" label="Nombramiento" name="ENombramiento" :options="$nombramientos->pluck('nombre', 'id')->toArray()"
                                selected="{{ $Principal->nombramiento }}" requiredIndicator="true" />


                            <x-select id="ECategoria" label="Categoría" name="ECategoria" :options="$categorias1->pluck('nombre', 'id')->toArray()"
                                selected="{{ $Principal->id_categoria }}" requiredIndicator="true" />

                            <div class="form-group col-12 campo_distincion pt-2">

                                <x-select id="EDistincion" label="Distinción adicional" name="EDistincion"
                                    :options="['' => 'Sin distinción'] +
                                        $distinciones->pluck('nombre', 'id')->toArray()" selected="{{ $Principal->distincion_ad ?? '--' }}" />

                            </div>


                            <x-input id="editAreaDistincion" label="Departamento /Área de Adscripción"
                                name="editAreaDistincion" value="{{ $Principal->area_distincion ?? '--' }}"
                                requiredIndicator="true" />


                            <x-select id="EEstado" label="Estatus laboral" name="EEstado" :options="$estados->pluck('nombre', 'id')->toArray()"
                                selected="{{ $Principal->id_estado }}" requiredIndicator="true" />


                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">
                                    @php
                                        // Mapear el grado
                                        $Hours = collect([
                                            ['id' => 1, 'nombre' => '20'],
                                            ['id' => 2, 'nombre' => '24'],
                                            ['id' => 3, 'nombre' => '36'],
                                            ['id' => 4, 'nombre' => '40'],
                                            ['id' => 5, 'nombre' => '48'],
                                            ['id' => 6, 'nombre' => 'Carga 0'],
                                            ['id' => 7, 'nombre' => 'No aplica'],
                                        ]);

                                        $Hours_seleccionado =
                                            $Hours->firstWhere('nombre', trim($Principal->horas_trabajo))['id'] ?? null;

                                    @endphp

                                    <x-select id="Ehours" label="Horas de trabajo" name="Ehours" :options="$Hours->pluck('nombre', 'id')->toArray()"
                                        selected="{{ $Hours_seleccionado }}" requiredIndicator="true" />

                                </div>
                                <div class="col-6">
                                    @php
                                        // Mapear el grado
                                        $Shifts = collect([
                                            ['id' => 1, 'nombre' => 'Matutino'],
                                            ['id' => 2, 'nombre' => 'Vespertino'],
                                            ['id' => 3, 'nombre' => 'Nocturno'],
                                            ['id' => 4, 'nombre' => 'Mixto'],
                                            ['id' => 5, 'nombre' => 'No aplica'],
                                        ]);

                                        $Shifts_seleccionado =
                                            $Shifts->firstWhere('nombre', trim($Principal->horas_trabajo))['id'] ??
                                            null;

                                    @endphp

                                    <x-select id="Eshift" label="Turno" name="Eshift" :options="$Shifts->pluck('nombre', 'id')->toArray()"
                                        selected="{{ $Shifts_seleccionado }}" requiredIndicator="true" />

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    @php
                                        // Mapear el grado
                                        $Contrato = collect([
                                            ['id' => 1, 'nombre' => 'Temporal'],
                                            ['id' => 2, 'nombre' => 'Interinato'],
                                            ['id' => 3, 'nombre' => 'Definitivo'],
                                        ]);

                                        $Contrato_seleccionado =
                                            $Contrato->firstWhere('nombre', trim($Principal->tipo_contrato))['id'] ??
                                            null;

                                    @endphp

                                    <x-select id="EContrato" label="Tipo de contrato" name="EContrato" :options="$Contrato->pluck('nombre', 'id')->toArray()"
                                        selected="{{ $Contrato_seleccionado }}" requiredIndicator="true" />

                                </div>
                                <div class="col-6 Contrato">
                                    <x-input type="date" id="Efecha_termino" label="Fecha de termino"
                                        name="Efecha_termino" value="{{ $Principal->fecha_termino ?? '--' }}"
                                        requiredIndicator="true" />

                                </div>
                            </div>

                            <div class="col d-flex justify-content-end mt-2 mb-0 pb-0">
                                <a data-bs-toggle="tooltip" data-bs-html="true"
                                    data-bs-title="Separa los días con una <em>coma</em> <b>(,)</b> para su mejor visualización">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                        viewBox="0 0 48 48">
                                        <circle cx="24" cy="24" r="21" fill="#2196F3" />
                                        <path fill="#fff" d="M22 22h4v11h-4z" />
                                        <circle cx="24" cy="16.5" r="2.5" fill="#fff" />
                                    </svg>
                                </a>
                            </div>


                            <div>
                                <label for="Ehor_oficial">Horario oficial: <span class="red-Color opc">*</span></label>
                                <div class="grow-wrap" data-replicated-value="{{ $Principal->horario_oficial }}">
                                    <textarea class="form-control form-disabled" aria-label="With textarea" name="Ehor_oficial" id="Ehor_oficial"
                                        onInput="this.parentNode.dataset.replicatedValue = this.value">{{ $Principal->horario_oficial }}</textarea>
                                </div>
                            </div>



                        </div>

 



                            <div class="row">

                                @if ($Principal->nombramiento == 6 || $Principal->nombramiento == 4)
                                    <div class="col-12 ">

                                        <hr class="mt-3" />

                                        <div class="col d-flex justify-content-between mt-2 mb-0 pb-0">
                                            <p class="mb-0 pb-0 fw-light d-felx align-items-center">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                        height="20" viewBox="0 0 22 22">
                                                        <path fill="#239BA7"
                                                            d="M9 5H8v12h1v-1h1v-1h1v-1h1v-1h1v-1h1v-2h-1V9h-1V8h-1V7h-1V6H9" />
                                                    </svg>
                                                </span>
                                                Semblanza que caracteriza al
                                                <i>profesor</i>.
                                            </p>

                                            <a data-bs-toggle="tooltip" data-bs-html="true"
                                                data-bs-title="Semblanza es la caracterización que se le da al profesor">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 48 48">
                                                    <circle cx="24" cy="24" r="21" fill="#2196F3" />
                                                    <path fill="#fff" d="M22 22h4v11h-4z" />
                                                    <circle cx="24" cy="16.5" r="2.5" fill="#fff" />
                                                </svg>
                                            </a>
                                        </div>






                                        <div class="form-group pt-2">
                                            <label for="edit_semblanza">Semblanza</label>
                                            <div class="grow-wrap"
                                                data-replicated-value="{{ $Principal->semblanza }}">
                                                <textarea class="form-control form-disabled" aria-label="With textarea" name="edit_semblanza" id="edit_semblanza"
                                                    onInput="this.parentNode.dataset.replicatedValue = this.value">{{ $Principal->semblanza }}</textarea>
                                            </div>
                                        </div>


                                    </div>
                                @endif


                                @if ($Principal->nombramiento == 6)
                                    <div class="col-12 ">
                                        <hr class="mt-3" />

                                        <div class="col d-flex justify-content-between mt-2 mb-0 pb-0">
                                            <p class="mb-0 pb-0 fw-light d-felx align-items-center">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                        height="20" viewBox="0 0 22 22">
                                                        <path fill="#239BA7"
                                                            d="M9 5H8v12h1v-1h1v-1h1v-1h1v-1h1v-1h1v-2h-1V9h-1V8h-1V7h-1V6H9" />
                                                    </svg>
                                                </span>
                                                Selecciona los <i>departamentos</i> a los que imparte clases.

                                            </p>

                                            <a data-bs-toggle="tooltip" data-bs-html="true"
                                                data-bs-title="Listado de departamentos">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 48 48">
                                                    <circle cx="24" cy="24" r="21" fill="#2196F3" />
                                                    <path fill="#fff" d="M22 22h4v11h-4z" />
                                                    <circle cx="24" cy="16.5" r="2.5" fill="#fff" />
                                                </svg>
                                            </a>
                                        </div>

                                        <div class="form-group pt-2">
                                            <label for=""> Departamento <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="edit_departaments"
                                                name="edit_departaments[]" multiple>
                                                @php
                                                    $dependenciasSeleccionadas = $Principal->departamento->pluck('id');
                                                @endphp
                                                @foreach ($departamentos as $key => $value)
                                                    <option @if ($dependenciasSeleccionadas->contains($value->id)) selected @endif
                                                        value="{{ $value->id }}">
                                                        {{ $value->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger fw-normal" style="display: none;">Dependencia no
                                                válida.</span>
                                        </div>
                                    </div>
                                @endif

                            </div>
 


                    </div>
                </div>

            </div>
            {{-- Botones del modal  --}}
            <div class="modal-footer mt-3 p-0 mb-1">
                <div class="pt-2 pb-0 gap-4">
                    <button class="btn fst-italic  animated-icon button-cancel cancel" data-bs-dismiss="modal"> <i
                            class="fa-solid fa-xmark"></i> Cancelar</button>
                    <button class="btn fst-italic animated-icon button-save" id="EditPrinc"
                        data-id="{{ $id }}"> <i class="fa-solid fa-check"></i> Guardar</button>
                </div>



            </div>
        </div>
    </div>
</div>
</div>
