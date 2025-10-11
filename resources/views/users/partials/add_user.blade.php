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
                    <div class="mt-1 col-12 d-flex justify-content-center align-items-center" id="texto">
                        <p style="font-size: 1rem;"> Ingresa los datos correspondientes </p>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <x-input id="user_name" label="Código de trabajador" name="user_name"
                                requiredIndicator="true" maxlength="7" />

                        </div>
                        <div class="col-4 mt-1">
                           <abbr  data-bs-toggle="tooltip" data-bs-html="true"
                                data-bs-title="Buscar el código de la persona.">
                             <button class="btn button-save fst-normal animated-icon px-4 mt-4" type="button"
                                id="SearchCode" tabindex="0">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                Buscar
                            </button>
                           </abbr>
                        </div>
                    </div>


                    {{-- <div class="row mx-2 mb-3">
                        <div class="col-8 text-center ">
                            <label for="user_name" class="fw-normal">Código</label>
                            <input type="text" class="form-control" id="user_name"
                                placeholder="Código de trabajador" maxlength="7">
                            <span class="text-danger fw-normal" style=" display: none;">Código
                                no válido.</span>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-search fst-normal ms-2 animated-icon px-2 mt-4" type="button"
                                id="SearchCode" tabindex="0">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                Buscar
                            </a>
                        </div>
                    </div> --}}
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
            <div class="modal-footer mb-1 pb-0 mt-2">
                <button type="button" class="btn button-cancel close_modal border" data-bs-dismiss="modal"
                    aria-label="Close">Cancelar</button>

                <abbr data-bs-toggle="tooltip" data-bs-html="true"
                                data-bs-title="Guardar los datos del usuario.">
                    <button class="btn button-save border d-none" type="button" id="save-User"> Guardar </button>
                </abbr>
            </div>
        </div>
    </div>
</div>
