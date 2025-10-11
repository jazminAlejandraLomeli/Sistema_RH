<!-- Modal para agregra un nombramiento desde la vista de detalles de una persona -->
<div class="modal fade" id="Principal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue-primary ">
                <h5 class="modal-title text-white" id="editModalLabel">Agregar nombramiento</h5>
                <button class="btn fst-italic animated-icon button-white close_modal" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="row pt-2">
                                <div class="form-group col-12">
                                    <label for="nombramientos">Nombramiento <span class="red-Color">*</span> </label>
                                    <select class="form-control" name="nombramientos" id="nombramientos">
                                        <option value="" disabled selected>Selecciona una opción</option>
                                        @foreach ($nombramientos as $nombramiento)
                                            <option value="{{ $nombramiento->id }}">{{ $nombramiento->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger fw-normal" style=" display: none;">Nombramiento no
                                        válido.</span>
                                </div>
                                <div class="form-group col-12 pt-2">
                                    <label for="categoria" style="display: block;">Categorias <span
                                            class="red-Color">*</span></label>
                                    <select disabled="disabled" class="form-control form-disabled" name="categorias"
                                        id="categorias">
                                        <option value="" disabled selected>Selecciona una opción</option>
                                    </select>
                                    <span class="text-danger fw-normal" style=" display: none;">Categoría no
                                        válida.</span>
                                </div>
                                <!-- Este campo estará oculto a no ser que el, nombramiento si tenga deisticiosn adiciinal -->
                                <div class="form-group col-12 d-none campo-distincion">
                                    <label for="Distincion_Adicional">Distincion adicional:</label>
                                    <select class="form-control form-disabled" name="Distincion_Adicional"
                                        id="Distincion_Adicional">
                                        <option value="" disabled selected>Selecciona una opción</option>
                                    </select>
                                    <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                                </div>
                                <div class="form-group col-12">
                                    <label for="dep">Departamento /Área de Adscripción <span
                                            class="red-Color">*</span></label>
                                    <input class="form-control form-disabled" type="text" name="dep"
                                        id="dep" disabled>
                                    <span class="text-danger fw-normal" style=" display: none;">Departamento no
                                        válido.</span>
                                </div>
                            </div>
                        </div>
                    </div> <!-- FIN contenedor 1  -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="hours">Horas de trabajo <span class="red-Color opc">*</span>
                                            </label>
                                            <select disabled class="form-control form-disabled" name="hours"
                                                id="hours">
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="1">20</option>
                                                <option value="2">24</option>
                                                <option value="3">36</option>
                                                <option value="4">40</option>
                                                <option value="5">48</option>
                                                <option value="6">No aplica</option>
                                                <option value="7">Carga 0</option>
                                            </select>
                                            <span class="text-danger fw-normal" style=" display: none;">Horas no
                                                válidas.</span>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="shift">Turno <span class="red-Color opc">*</span></label>
                                            <select disabled class="form-control form-disabled" name="shift"
                                                id="shift">
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="1">Matutino</option>
                                                <option value="2">Vespertino</option>
                                                <option value="3">Nocturno</option>
                                                <option value="4">Mixto</option>
                                                <option value="5">No aplica</option>
                                            </select>
                                            <span class="text-danger fw-normal" style=" display: none;">Turno no
                                                válido.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-12">
                                            <label for="hor_oficial">Horario oficial: <span
                                                    class="red-Color opc">*</span> </label>
                                            <textarea disabled class="form-control form-disabled" aria-label="With textarea" name="hor_oficial" id="hor_oficial"
                                                placeholder="Lunes de 08:00 - 15:00, Martes de 10:00 - 19:00"></textarea>
                                            <span class="text-danger fw-normal" style=" display: none;">Horario no
                                                válido.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="contrato">Tipo de contrato <span
                                                    class="red-Color">*</span></label>
                                            <select disabled class="form-control form-disabled" name="contrato"
                                                id="contrato">
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="1">Temporal</option>
                                                <option value="2">Interinato</option>
                                                <option value="3">Definitivo</option>
                                            </select>
                                            <span class="text-danger fw-normal" style=" display: none;">Tipo no
                                                válido.</span>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12 Contrato">
                                            <label for="fecha_termino" style="display: block;">Fecha de termino <span
                                                    class="red-Color">*</span></label>
                                            <input disabled class="form-control form-disabled" type="date"
                                                id="fecha_termino" name="fecha_termino">
                                            <span class="text-danger fw-normal" style=" display: none;">Fecha no
                                                válida.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 

            <div class="col-12 d-nne" id="containerDepartament">
                <hr class="mt-3" />
                <p class="pt-1 mb-0 text-center">Selecciona los departamentos a los cuales impartirá clases
                    y escribe la semblanza del profesor en caso de ya tener una.</p>

                <div class="col d-flex justify-content-end mt-2 mb-0 pb-0">
                    <a data-bs-toggle="tooltip" data-bs-html="true"
                        data-bs-title="Semblanza es una breve descripción sobre la trayectoria del profesor(a) ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 16 16">
                            <path fill="#0891b2" fill-rule="evenodd"
                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M4.927 4.99Q4.5 5.634 4.5 6.26q0 .305.27.566t.661.26q.665 0 .903-.746q.252-.713.616-1.08q.364-.366 1.134-.366q.658 0 1.075.363q.416.364.416.892a.97.97 0 0 1-.136.502a2 2 0 0 1-.336.419a14 14 0 0 1-.648.558q-.51.423-.812.73q-.3.308-.483.713c-.322 1.245 1.35 1.345 1.736.456q.07-.128.213-.284q.144-.155.382-.36a41 41 0 0 0 1.194-1.034q.332-.306.573-.73a1.95 1.95 0 0 0 .242-.984q0-.712-.424-1.32q-.423-.609-1.2-.962T8.084 3.5q-1.092 0-1.911.423T4.927 4.989Zm2.14 7.08a1 1 0 1 0 2 0a1 1 0 0 0-2 0"
                                clip-rule="evenodd" />
                        </svg> </a>
                </div>

                <div class="row mt-3 border">

                    <div class="col-12 col-md-6 col-xl-6 ">
                        <x-select id="department" label="Departamento" name="departments[]" :options="['' => 'Selecciona los departamentos'] +
                            $departamentos->pluck('nombre', 'id')->toArray()"
                            requiredIndicator="true" />
                    </div>


                    <div class="col-12 col-md-6 col-xl-6 ">
                        <label for="hor_oficial">Semblanza </label>
                        <div class="grow-wrap">
                            <textarea class="form-control form-disabled" aria-label="With textarea" name="semblanza" id="semblanza"
                                placeholder="Escribe la semblanza"></textarea>
                        </div>
                    </div>
                </div>

            </div>




            {{-- Botones del modal  --}}
            <div class="modal-footer mt-3 p-0 mb-2">
                <div class="pt-2 pb-0 gap-4">
                    <button class="btn fst-italic animated-icon button-cancel btn-cerrar" data-bs-dismiss="modal"> <i
                            class="fa-solid fa-xmark"></i> Cancelar</button>
                    <button class="btn fst-italic animated-icon button-save" id="save-job"
                        data-id="{{ $id }}" disabled> <i class="fa-solid fa-check"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
