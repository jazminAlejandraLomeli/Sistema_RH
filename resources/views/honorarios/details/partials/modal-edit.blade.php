<!-- Modal -->
<div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="Modal edit register" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-grid">
                <h1 class="modal-title fs-5" id="modalEditTitle">Editar datos del honorario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="pt-1 mb-0">Escribe los datos correspondientes para agregar nuevo trabajador al sistema.</p>
                <form id="formEdit" action="#" method="POST">
                    @csrf
                    <input type="hidden" id="id" value="{{ $Persona->id }}">
                    <div class="row ">
                        <div class="col-12 col-md-6 col-xl-6 mt-1">
                            <div class="row">
                                <div class="col-12">
                                    <abbr data-bs-toggle="tooltip" data-bs-html="true"
                                        data-bs-title="Este código es genérico y único, solo tiene uso interno para el sistema">
                                        <x-input id="code" label="Código" value="{{ $Persona->codigo }}"
                                            :disableIndicator="true" name="code" :requiredIndicator="false" maxlength="7" />
                                    </abbr>
                                </div>

                                <div class="col-12">
                                    <x-input id="name" label="Nombre completo" name="name"
                                        requiredIndicator="true" value="{{ $Persona->nombre }}" />

                                </div>
                            </div>

                            <x-select id="gender" label="Género" name="gender" :options="['' => 'Selecciona un género'] +
                                $llenadoFormulario->sexo->pluck('nombre', 'id')->toArray()"
                                requiredIndicator="true" selected="{{ $datosSelecionado->genero }}" />

                            <x-input id="email" label="Correo" name="email" value="{{ $Persona->correo }}" />

                            <x-input id="birthdate" label="F. de nacimiento" name="birthdate" requiredIndicator="true"
                                type="date" value="{{ $Persona->fecha_nacimiento }}" />

                        </div>
                        <div class="col-12 col-md-6 col-xl-6 mt-1">

                            <x-input id="entryDate" label="F. de ingreso a UDG" name="entry_date"
                                requiredIndicator="true" type="date" value="{{ $Persona->fecha_ingreso }}" />
                            <div>
                                <x-select id="degreeOfStudies" label="Grado de estudios" name="degree_of_studies"
                                    :options="['' => 'Selecciona un grado'] +
                                        $llenadoFormulario->grado->pluck('nombre', 'id')->toArray()" requiredIndicator="true"
                                    selected="{{ $datosSelecionado->genero }}" />
                            </div>
                            <hr class="mt-3">

                            <div class="row">
                                <p>Información del contrato de honorarios</p>
                                <div class="col-12">
                                    <x-input id="responsible" label="Responsable" name="responsible"
                                        requiredIndicator="true" type="text"
                                        value="{{ $Persona->honorario->responsable }}" />
                                </div>
                                <div class="col-12 col-lg-6">
                                    <x-input id="rfc" label="RFC" name="rfc" requiredIndicator="true"
                                        type="text" value="{{ $Persona->honorario->rfc }}" />
                                </div>
                                <div class="col-12 col-lg-6">
                                    <x-input id="area" label="Área de asignación" name="area"
                                        requiredIndicator="true" type="text"
                                        value="{{ $Persona->honorario->area }}" />
                                </div>
                            </div>


                        </div>
                    </div>
                    {{-- <div class="col-12 d-lg-flex justify-content-lg-end mt-3">
                        <div class="d-flex flex-column flex-lg-row gap-3">
                            <a class="btn fst-italic  animated-icon button-cancel back"> <i
                                    class="pe-2 fa-solid fa-xmark"></i>
                                Cancelar</a>

                            <button type="submit" class="btn fst-italic  animated-icon  button-save"
                                id="personal-data">
                                Guardar <i class="ps-2 fa-solid fa-arrow-right"></i></button>
                        </div>


                    </div> --}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" >Cancelar</button>
                <button class="btn fst-italic  animated-icon button-save" id="personal-data">
                    Guardar <i class="ps-2 fa-solid fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
</div>
