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
                                            <textarea disabled class="form-control form-disabled" aria-label="With textarea" name="hor_oficial"
                                                id="hor_oficial" placeholder="Lunes de 08:00 - 15:00, Martes de 10:00 - 19:00"></textarea>
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
