<div class="card">
    <h5 class="card-header bg-blue-primary text-white text-center">Datos del honorario</h5>
    <div class="card-body Personal-Data">
        <p class="pt-1 mb-0">Escribe los datos correspondientes para agregar nuevo trabajador al sistema.</p>
        <form id="formCreate" action={{route('honorarios.store')}} method="POST">
            @csrf
            <div class="row ">
                <div class="col-12 col-md-6 col-xl-6 mt-1">
                    <div class="row">
                        <div class="col-12">
                            <abbr data-bs-toggle="tooltip" data-bs-html="true"
                                data-bs-title="Este código es genérico y único, solo tiene uso interno para el sistema">
                                <x-input id="code" label="Código" value="{{ $codigo }}" :disableIndicator="true"
                                    name="code" :requiredIndicator="false" maxlength="7" />
                            </abbr>                            
                        </div>

                        <div class="col-12">
                            <x-input id="name" label="Nombre completo" name="name" requiredIndicator="true" />

                        </div>
                    </div>

                    <x-select id="gender" label="Género" name="gender" :options="['' => 'Selecciona un género'] +
                        $llenadoFormulario->sexo->pluck('nombre', 'id')->toArray()" requiredIndicator="true" />

                    <x-input id="email" label="Correo" name="email" />

                    <x-input id="birthdate" label="F. de nacimiento" name="birthdate" requiredIndicator="true"
                        type="date" />

                </div>
                <div class="col-12 col-md-6 col-xl-6 mt-1">

                    <x-input id="entryDate" label="F. de ingreso a UDG" name="entry_date" requiredIndicator="true"
                        type="date" />
                    <div >
                        <x-select id="degreeOfStudies" label="Grado de estudios" name="degree_of_studies" :options="['' => 'Selecciona un grado'] +
                            $llenadoFormulario->grado->pluck('nombre', 'id')->toArray()"
                            requiredIndicator="true" />
                    </div>
                    <hr class="mt-3">

                    <div class="row">
                        <p>Información del contrato de honorarios</p>
                        <div class="col-12">
                            <x-input id="responsible" label="Responsable" name="responsible" requiredIndicator="true"
                                type="text" />
                        </div>
                        <div class="col-12 col-lg-6">
                            <x-input id="rfc" label="RFC" name="rfc" requiredIndicator="true"
                                type="text" />
                        </div>
                        <div class="col-12 col-lg-6">
                            <x-input id="area" label="Área de asignación" name="area" requiredIndicator="true"
                                type="text" />
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-12 d-lg-flex justify-content-lg-end mt-3">
                <div class="d-flex flex-column flex-lg-row gap-3">
                    <a class="btn fst-italic  animated-icon button-cancel back"> <i class="pe-2 fa-solid fa-xmark"></i>
                        Cancelar</a>

                    <button type="submit" class="btn fst-italic  animated-icon  button-save" id="personal-data"> Guardar <i
                            class="ps-2 fa-solid fa-arrow-right"></i></button>
                </div>


            </div>
        </form>
    </div>
</div>
