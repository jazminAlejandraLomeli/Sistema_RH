{{-- Modal para la edicion de los datos del nombramirnto secundario  --}}




{{-- Modal para la edicion delos datos del nombramiento principal  --}}
<div class="modal fade" id="EditarSecunadario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue-primary d-felx justify-content-between">
                <h5 class="modal-title text-white" id="modalDetallesNombramientoLabel">Actualizar nombramiento
                    secundario</h5>
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
                            <x-select id="Nombramiento" label="Nombramiento" name="Nombramiento" :options="$nombramientos->pluck('nombre', 'id')->toArray()"
                                selected="{{ $Trabajo->nombramiento }}" requiredIndicator="true" />


                            <x-select id="SCategoria" label="Categoría" name="SCategoria" :options="$categorias2->pluck('nombre', 'id')->toArray()"
                                selected="{{ $Trabajo->id_categoria }}" requiredIndicator="true" />


                            <!-- Este campo estará oculto a no ser que el, nombramiento si tenga deisticiosn adicional -->
                            <div class="form-group col-12 pt-2 campo-dist">
                                <x-select id="SDistincion" label="Distinción adicional" name="SDistincion"
                                    :options="['' => 'Sin distinción'] +
                                        $distinciones->pluck('nombre', 'id')->toArray()" selected="{{ $Trabajo->distincion_ad }}" />

                            </div>
                            <x-input id="SAdscript" label="Departamento /Área de Adscripción" name="SAdscript"
                                value="{{ $Trabajo->area_distincion ?? '--' }}" requiredIndicator="true" />


                            <x-select id="SEstado" label="Estatus laboral" name="SEstado" :options="$estados->pluck('nombre', 'id')->toArray()"
                                selected="{{ $Trabajo->id_estado }}" requiredIndicator="true" />


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
                                            $Hours->firstWhere('nombre', trim($Trabajo->horas_trabajo))['id'] ?? null;

                                    @endphp

                                    <x-select id="Shours" label="Horas de trabajo" name="Shours" :options="$Hours->pluck('nombre', 'id')->toArray()"
                                        selected="{{ $Hours_seleccionado }}" requiredIndicator="true" />

                                </div>
                                <div class="col-6">
                                    @php
                                        // Mapear el grado
                                        $Shift = collect([
                                            ['id' => 1, 'nombre' => 'Matutino'],
                                            ['id' => 2, 'nombre' => 'Vespertino'],
                                            ['id' => 3, 'nombre' => 'Nocturno'],
                                            ['id' => 4, 'nombre' => 'Mixto'],
                                            ['id' => 5, 'nombre' => 'No aplica'],
                                        ]);

                                        $Shifts2_seleccionado =
                                            $Shift->firstWhere('nombre', trim($Trabajo->horas_trabajo))['id'] ?? null;

                                    @endphp

                                    <x-select id="Sshift" label="Turno" name="Sshift" :options="$Shift->pluck('nombre', 'id')->toArray()"
                                        selected="{{ $Shifts2_seleccionado }}" requiredIndicator="true" />

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

                                        $Contrato2_seleccionado =
                                            $Contrato->firstWhere('nombre', trim($Trabajo->tipo_contrato))['id'] ??
                                            null;

                                    @endphp

                                    <x-select id="SContrato" label="Tipo de contrato" name="SContrato" :options="$Contrato->pluck('nombre', 'id')->toArray()"
                                        selected="{{ $Contrato2_seleccionado }}" requiredIndicator="true" />

                                </div>
                                <div class="col-6 Contrato">
                                    <x-input type="date" id="Sfecha_termino" label="Fecha de termino"
                                        name="Sfecha_termino" value="{{ $Trabajo->fecha_termino ?? '--' }}"
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

                            <label for="Shor_oficial">Horario oficial: <span class="red-Color opc">*</span></label>
                            <div class="grow-wrap" data-replicated-value="{{ $Trabajo->horario_oficial }}">
                                <textarea class="form-control form-disabled" aria-label="With textarea" name="Shor_oficial" id="Shor_oficial"
                                    onInput="this.parentNode.dataset.replicatedValue = this.value">{{ $Trabajo->horario_oficial }}</textarea>
                            </div>

                        </div>


                        
                            <div class="row">

                                @if ($Trabajo->nombramiento == 6 || $Trabajo->nombramiento == 4)
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
                                            <label for="second_semblanza">Semblanza</label>
                                            <div class="grow-wrap"
                                                data-replicated-value="{{ $Trabajo->semblanza }}">
                                                <textarea class="form-control form-disabled" aria-label="With textarea" name="second_semblanza" id="second_semblanza"
                                                    onInput="this.parentNode.dataset.replicatedValue = this.value">{{ $Trabajo->semblanza }}</textarea>
                                            </div>
                                        </div>


                                    </div>
                                @endif


                                @if ($Trabajo->nombramiento == 6)
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
                                            <label for="second_departaments"> Departamento <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="second_departaments"
                                                name="second_departaments[]" multiple>
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
            <div class="modal-footer mt-3 p-0 mb-2">
                <div class="pt-2 pb-0 gap-4">
                    <button class="btn fst-italic  animated-icon button-cancel cancel" data-bs-dismiss="modal"> <i
                            class="fa-solid fa-xmark"></i> Cancelar</button>
                    <button class="btn fst-italic animated-icon button-save" id="EditSecu"
                        data-id="{{ $id }}"> <i class="fa-solid fa-check"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
