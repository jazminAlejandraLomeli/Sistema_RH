<!-- Modal para agregar a un nuevo usuario al sistema-->
<div class="modal fade" id="Details_User" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content mb-0">
            <div class="modal-header bg-blue-primary d-flex justify-content-between">
                <h5 class="modal-title text-center text-white" id="confirmModalLabel">Detalles del usuario</h5>
                <button class="btn fst-italic animated-icon button-white close_modal" data-bs-dismiss="modal"
                    id="cerrar_modal"> <i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body ">

                <div class="row">
                    <div class="form-group col-8">
                        <x-icon-cont
                            icon=' <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                 <g fill="none" stroke="#06285c" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="1.5" color="#06285c">
                                     <path
                                         d="M8.5 18c1.813-1.954 5.167-2.046 7 0m-1.56-6c0 1.105-.871 2-1.947 2c-1.075 0-1.947-.895-1.947-2s.872-2 1.947-2s1.948.895 1.948 2" />
                                     <path
                                         d="M9.5 4.002c-2.644.01-4.059.102-4.975.97C3.5 5.943 3.5 7.506 3.5 10.632v4.737c0 3.126 0 4.69 1.025 5.66c1.025.972 2.675.972 5.975.972h3c3.3 0 4.95 0 5.975-.971c1.025-.972 1.025-2.535 1.025-5.66v-4.738c0-3.126 0-4.689-1.025-5.66c-.916-.868-2.33-.96-4.975-.97" />
                                     <path
                                         d="M9.772 3.632c.096-.415.144-.623.236-.792a1.64 1.64 0 0 1 1.083-.793C11.294 2 11.53 2 12 2s.706 0 .909.047a1.64 1.64 0 0 1 1.083.793c.092.17.14.377.236.792l.083.36c.17.735.255 1.103.127 1.386a1.03 1.03 0 0 1-.407.451C13.75 6 13.332 6 12.498 6h-.996c-.834 0-1.252 0-1.533-.17a1.03 1.03 0 0 1-.407-.452c-.128-.283-.043-.65.127-1.386z" />
                                 </g>
                             </svg>'
                            label="Nombre de Usuario" text="216610402" id="User_name" />
                    </div>

                    <div class="form-group col-4">
                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#06285c" fill-rule="evenodd" d="M18.98 9.253a7.52 7.52 0 0 0-4.233-4.234a3 3 0 0 0-.534.868a6.52 6.52 0 0 1 3.9 3.9a3 3 0 0 0 .868-.534m-6.752-3.75L12 5.5a6.5 6.5 0 1 0 6.496 6.272q.516-.162.976-.425q.027.323.028.653a7.5 7.5 0 1 1-6.847-7.472a5 5 0 0 0-.425.976" clip-rule="evenodd"/><circle cx="17" cy="7" r="3" fill="#06285c"/></svg>'
                            label="Estado" text="Activo" id="Status" />
                    </div>
                </div>
                <x-icon-cont
                    icon='<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48"><path fill="none" stroke="#06285c" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M24 20a7 7 0 1 0 0-14a7 7 0 0 0 0 14M6 40.8V42h36v-1.2c0-4.48 0-6.72-.872-8.432a8 8 0 0 0-3.496-3.496C35.92 28 33.68 28 29.2 28H18.8c-4.48 0-6.72 0-8.432.872a8 8 0 0 0-3.496 3.496C6 34.08 6 36.32 6 40.8"/></svg>'
                    label="Nombre" text="SOLANO GUZMÁN EDUARDO" id="Name" />

                <div class="row col-12">
                    <div class="col-12 col-md-6 col-xl-6">
                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#06285c" fill-rule="evenodd" d="M17.297 6.572c-.41 0-.75-.34-.75-.75V4.598c-.774-.026-1.683-.026-2.75-.026h-2c-1.068 0-1.976 0-2.75.026v1.224c0 .41-.34.75-.75.75s-.75-.34-.75-.75V4.706c-.945.123-1.594.36-2.05.816c-.602.602-.822 1.54-.903 3.05H21c-.081-1.51-.302-2.448-.903-3.05c-.456-.456-1.105-.693-2.05-.816v1.116c0 .41-.34.75-.75.75m3.744 3.5q.008.793.006 1.75v1c0 .41.34.75.75.75s.75-.34.75-.75v-1c0-3.98 0-5.97-1.39-7.36c-.772-.772-1.73-1.115-3.11-1.268v-.872c0-.41-.34-.75-.75-.75s-.75.34-.75.75v.775c-.796-.025-1.705-.025-2.75-.025h-2c-1.046 0-1.954 0-2.75.025v-.775c0-.41-.34-.75-.75-.75s-.75.34-.75.75v.872c-1.38.153-2.338.496-3.11 1.268c-1.39 1.39-1.39 3.39-1.39 7.36v2c0 3.98 0 5.97 1.39 7.36s3.38 1.39 7.36 1.39c.41 0 .75-.34.75-.75s-.34-.75-.75-.75c-3.56 0-5.35 0-6.3-.95s-.95-2.74-.95-6.3v-2q-.001-.956.005-1.75zm-3.244 13c-2.62 0-4.75-2.13-4.75-4.75s2.13-4.75 4.75-4.75s4.75 2.13 4.75 4.75s-2.13 4.75-4.75 4.75m0-8c-1.79 0-3.25 1.46-3.25 3.25s1.46 3.25 3.25 3.25s3.25-1.46 3.25-3.25s-1.46-3.25-3.25-3.25m.47 4.78c.15.15.34.22.53.22s.38-.07.53-.22c.29-.29.29-.77 0-1.06l-.78-.78v-1.69c0-.41-.34-.75-.75-.75s-.75.34-.75.75v2c0 .2.08.39.22.53z" color="#06285c"/></svg>'
                            label="Rol / Tipo de usuario" text="dfgdfddf" id="Role" />

                    </div>
                    <div class="col-12 col-md-6 col-xl-6">
                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#06285c" fill-rule="evenodd" d="M17.297 6.572c-.41 0-.75-.34-.75-.75V4.598c-.774-.026-1.683-.026-2.75-.026h-2c-1.068 0-1.976 0-2.75.026v1.224c0 .41-.34.75-.75.75s-.75-.34-.75-.75V4.706c-.945.123-1.594.36-2.05.816c-.602.602-.822 1.54-.903 3.05H21c-.081-1.51-.302-2.448-.903-3.05c-.456-.456-1.105-.693-2.05-.816v1.116c0 .41-.34.75-.75.75m3.744 3.5q.008.793.006 1.75v1c0 .41.34.75.75.75s.75-.34.75-.75v-1c0-3.98 0-5.97-1.39-7.36c-.772-.772-1.73-1.115-3.11-1.268v-.872c0-.41-.34-.75-.75-.75s-.75.34-.75.75v.775c-.796-.025-1.705-.025-2.75-.025h-2c-1.046 0-1.954 0-2.75.025v-.775c0-.41-.34-.75-.75-.75s-.75.34-.75.75v.872c-1.38.153-2.338.496-3.11 1.268c-1.39 1.39-1.39 3.39-1.39 7.36v2c0 3.98 0 5.97 1.39 7.36s3.38 1.39 7.36 1.39c.41 0 .75-.34.75-.75s-.34-.75-.75-.75c-3.56 0-5.35 0-6.3-.95s-.95-2.74-.95-6.3v-2q-.001-.956.005-1.75zm-3.244 13c-2.62 0-4.75-2.13-4.75-4.75s2.13-4.75 4.75-4.75s4.75 2.13 4.75 4.75s-2.13 4.75-4.75 4.75m0-8c-1.79 0-3.25 1.46-3.25 3.25s1.46 3.25 3.25 3.25s3.25-1.46 3.25-3.25s-1.46-3.25-3.25-3.25m.47 4.78c.15.15.34.22.53.22s.38-.07.53-.22c.29-.29.29-.77 0-1.06l-.78-.78v-1.69c0-.41-.34-.75-.75-.75s-.75.34-.75.75v2c0 .2.08.39.22.53z" color="#06285c"/></svg>'
                            label="Fecha de ingreso" text="Marzo 25, 2025" id="Date_ing" />
                    </div>
                </div>

                {{-- Boton que abre el collapse para actualizar el rol del usuario --}}
                <div class="col-12 justify-content-center d-flex align-items-center">
                    <a class="" data-bs-toggle="collapse" href="#edit_role" role="button" aria-expanded="false"
                        aria-controls="collapseExample">
                        <svg data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="Actualizar el rol del usuario."
                            xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20">
                            <path fill="#06285c"
                                d="M10.103 12.778L16.81 6.08a.69.69 0 0 1 .99.012a.726.726 0 0 1-.012 1.012l-7.203 7.193a.69.69 0 0 1-.985-.006L2.205 6.72a.727.727 0 0 1 0-1.01a.69.69 0 0 1 .99 0z" />
                        </svg>
                    </a>
                </div>

                <div class="collapse" id="edit_role">
                    <div class="card card-body">
                        <p class="text-center"> Actualiza el rol correspondiente, segun los permisos que deseas
                            otorgarle al usuario </p>

                        <div>
                            <input type="hidden" value="" id="id_user" class="d-none">

                            <x-select id="roles" label="Selecciona el nuevo rol" name="roles" :options="['' => 'Selecciona un rol'] + $Roles->pluck('name', 'id')->toArray()"
                                requiredIndicator="true" />
                        </div>

                        <div class="col justify-content-center d-flex align-items-center mt-2">
                            <abbr data-bs-toggle="tooltip" data-bs-html="true"
                                data-bs-title="Guardar cambios realizados en el usuario.">
                                <button class="btn button-save border" type="button" id="Update_User"> Guardar
                                </button>
                            </abbr>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn button-cancel close_modal border" data-bs-dismiss="modal"
                    aria-label="Close">Cerrar</button>
            </div>
        </div>
    </div>
</div>
