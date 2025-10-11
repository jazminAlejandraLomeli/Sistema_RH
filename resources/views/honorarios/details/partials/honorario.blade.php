<div class="card shadow-sm animate__animated animate__fadeInDown mt-1">
    <div class="card-body">
        <h5 class="card-title text-center">Datos del contrato</h5>
        <div class="row pt-2">
            <div class="col-12 col-md-6 col-xl-6">

                <div class="row pt-2">
                    <div class="form-group col-6">
                        <x-icon-cont
                            icon=' <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#373CC4" d="M18 15h-2v2h2m0-6h-2v2h2m2 6h-8v-2h2v-2h-2v-2h2v-2h-2V9h8M10 7H8V5h2m0 6H8V9h2m0 6H8v-2h2m0 6H8v-2h2M6 7H4V5h2m0 6H4V9h2m0 6H4v-2h2m0 6H4v-2h2m6-10V3H2v18h20V7z"/></svg>'
                            label="Área asignada" text="{{ $Persona->honorario->area }}" id="area" />
                    </div>

                    <div class="form-group col-6">

                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#373CC4" d="M17 15q-1.05 0-1.775-.725T14.5 12.5t.725-1.775T17 10t1.775.725t.725 1.775t-.725 1.775T17 15m-5 4v-.4q0-.6.313-1.112t.887-.738q.9-.375 1.863-.562T17 16t1.938.188t1.862.562q.575.225.888.738T22 18.6v.4q0 .425-.288.713T21 20h-8q-.425 0-.712-.288T12 19m-2-7q-1.65 0-2.825-1.175T6 8t1.175-2.825T10 4t2.825 1.175T14 8t-1.175 2.825T10 12m-8 5.2q0-.85.425-1.562T3.6 14.55q1.5-.75 3.113-1.15T10 13q.875 0 1.75.15t1.75.35l-.85.85l-.85.85q-.45-.125-.9-.162T10 15q-1.45 0-2.838.35t-2.662 1q-.25.125-.375.35T4 17.2v.8h6v.975q0 .325.125.588t.35.437H4q-.825 0-1.412-.587T2 18zm8-7.2q.825 0 1.413-.587T12 8t-.587-1.412T10 6t-1.412.588T8 8t.588 1.413T10 10"/></svg>'
                            label="Responsable" text="{{ $Persona->honorario->responsable }}" id="Person_sex" />



                    </div>
                </div>


            </div>

            {{-- Contenedor del lado derecho  --}}

            {{-- <div class="col-12 col-md-6 col-xl-6">

                <div class="row pt-2">
                    <div class="form-group col-6">


                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 32 32"><path d="M10 9h2v2h-2z" fill="#373CC4"/><path d="M18 23h-4V9h4a4 4 0 0 1 4 4v6a4 4 0 0 1-4 4zm-2-2h2a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-2z" fill="#373CC4"/><path d="M10 13h2v10h-2z" fill="#373CC4"/></svg>'
                            label="RFC" text="{{ $Persona->honorario->rfc }} " id="Person_rfc" />

                    </div>
                    <div class="form-group col-6">


                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 22v-9.602c0-1.068 0-1.602.245-2.05c.244-.448.693-.737 1.592-1.315l2.082-1.338c.525-.337.787-.506 1.081-.506s.556.169 1.082.506l2.081 1.338c.899.578 1.348.867 1.592 1.315c.245.448.245.982.245 2.05V22m-5-9h.009M21 22v-5.838c0-2.291-1.26-2.477-4-3.162M3 22v-5.838C3 13.871 4.26 13.685 7 13m-5 9h20m-10 0v-4m0-11V4.982m0 0V2.97c0-.474 0-.711.146-.858c.46-.463 2.354.631 3.074 1.075c.608.374.78 1.122.78 1.795z" color="#373CC4"/></svg>'
                            label="Grado de estudios" text="{{ $Persona->ultimo_grado }} " id="Person_Grade" />

                    </div>
                </div>



            </div> --}}

            <!-- botones -->
            <div class="col-12 d-flex justify-content-end mt-2">
                @role('Administrador')
                    <div>
                        <abbr title="Editar los datos del nombramiento.">
                            <button id="botonEditar" class="btn fst-normal px-4 animated-icon button-edit"
                                data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="fa-solid fa-pen animated-icon px-1"></i> Editar
                            </button>
                        </abbr>
                    </div>
                @endrole
            </div>
        </div>
    </div>
</div>
