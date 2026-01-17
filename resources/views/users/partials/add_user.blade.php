<!-- Modal para agregar a un nuevo usuario al sistema-->
<div class="modal fade" id="Add-User" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-blue-primary d-flex justify-content-between">
                <h5 class="modal-title text-center text-white" id="confirmModalLabel">Agregar usuario al sistema</h5>
                <button class="btn fst-italic animated-icon button-white close_modal" data-bs-dismiss="modal"
                    id="cerrar_modal"> <i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body text-center">
                <div id="alerta" class="alert d-none pb-0 m-0 text-center" role="alert">
                    <p class="texto"></p>
                </div>
                <div id="paso1">
                    <div class="mt-1 col-12 d-flex justify-content-center align-items-start" id="texto">
                        <p style="font-size: 1rem;"> El código debe pertenecer a una persona del centro universitario
                        </p>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <x-input id="user_name" label="Código de trabajador" name="user_name"
                                requiredIndicator="true" maxlength="7" />

                        </div>
                        <div class="col-4 mt-2">

                            <div class="flex-fill flex-lg-grow-0 mt-4" data-bs-toggle="tooltip" data-bs-html="true"
                                data-bs-title="Buscar el código de la persona.">
                                <x-save-button-component text="Buscar" id="SearchCode" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center align-items-center paso2 d-none">
                    <p class="text-center pt-0" style="font-size: 1rem;">Datos del usuario </p>
                    <div class="row col-12 mb-3">
                        <div class="col-3">
                            <div for="code_U" class="fw-normal">Código:</div>
                            <span id="code_U">2726319</span>
                        </div>
                        <div class="col-9 ">
                            <div for="name" class="fw-normal">Nombre completo:</div>
                            <span id="name">SOLANO GUZMAN EDUARDO</span>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12 mb-3">
                        <p style="font-size: 1rem;"> Selecciona un tipo de usuario</p>
                        <div class="d-flex justify-content-center gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Tipo_Usuario" id="op1"
                                    value="2" checked>
                                <label class="form-check-label" for="op1">
                                    Lectura
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Tipo_Usuario" id="op2"
                                    value="1">
                                <label class="form-check-label" for="op2">
                                    Administrador
                                </label>
                            </div>
                        </div>
                        <p class="mt-2 text-center mb-0" style="font-size: 0.75rem;"> La contraseña por defecto será
                            <span class="fw-bold"> {{ config('app.default_pass') }}</span>.
                        </p>
                    </div>
                </div>

            </div>
            <div class="modal-footer mb-1 pb-0 mt-2 py-3">
              

                <div class="flex-fill flex-lg-grow-0" data-bs-toggle="tooltip" data-bs-html="true"
                    data-bs-title="Cancelar la operación.">
                    <x-delete-button-component text="Cancelar" class="close_modal" data-bs-dismiss="modal"
                    aria-label="Close" />
                </div>
                
                <div class="flex-fill flex-lg-grow-0 paso2 d-none" data-bs-toggle="tooltip" data-bs-html="true"
                    data-bs-title="Cancelar la operación.">
                    <x-save-button-component text="Guardar" id="save-User" />
                </div>

                

            </div>
        </div>
    </div>
</div>
