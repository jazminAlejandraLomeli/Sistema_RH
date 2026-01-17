{{-- Boton para ver la información del domicilio  --}}
<div class="d-flex justify-content-center mb-0">

    <button class="btn animated-icon button-add" type="button" data-bs-toggle="collapse" data-bs-target="#address-collapse"
        aria-expanded="false" aria-controls="address-collapse">
        Información del domicilio
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48">
            <path fill="currentColor" d="M43 17.1L39.9 14L24 29.9L8.1 14L5 17.1L24 36z" />
        </svg>

    </button>
</div>

{{-- Collapse con la informacion del domicilio  --}}
<div class=" collapse pb-3" id="address-collapse">
    <div class="row mt-3 pb-3 card p-3 mw-75 mx-auto">

        <x-section-divider text="Datos del domicilio" color="#0284c7" />

        <div class="row mt-3 px-0 animate__animated animate__fadeInDown">

            <div class="col-12 col-md-6 col-xl-6">

                <x-icon-cont
                    icon='<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 512 512"><path fill="#65a30d" d="M17.91 93.761c19.4 67.244 47.029 124.21 79.363 187.172l27.561-8.368c-34.337-52.44-62.494-96.45-72.16-152.817l24.231 6.32c12.377 75.413 79.95 133.444 109.213 168.56c4.905 16.388.589 32.776-4.916 46.354c51.616 25.103 104.672 57.56 163.292 69.531c22.014-17.212 44.264-27.73 68.126 7.726l9.833-28.094l23.177-.702L432.636 361c22.372 8.044 50.335-16.05 50.92-22.826c1.675-19.426.496-31.362 10.535-47.056l-55.836 7.725c-1.367 16.264 1.583 34.771-15.1 44.247c-88.44 50.234-115.313-62.388-107.457-109.564c-36.356-16.025-40.996-34.962-62.507-68.126l-22.475-2.81l-15.451 13.345l-40.033-51.27z"/></svg>'
                    label="Estado" text="{{ $Worker->domicilio->estado ?? '--' }}" id="state" />
                <x-icon-cont
                    icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48"><g fill="none"><path stroke="#65a30d" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M4 42h40"/><rect width="8" height="16" x="8" y="26" stroke="#65a30d" stroke-linejoin="round" stroke-width="4" rx="2"/><path stroke="#65a30d" stroke-linecap="square" stroke-linejoin="round" stroke-width="4" d="M12 34h1"/><rect width="24" height="38" x="16" y="4" stroke="#65a30d" stroke-linejoin="round" stroke-width="4" rx="2"/><path fill="#65a30d" d="M22 10h4v4h-4zm8 0h4v4h-4zm-8 7h4v4h-4zm8 0h4v4h-4zm0 7h4v4h-4zm0 7h4v4h-4z"/></g></svg>'
                    label="Ciudad" text="{{ $Worker->domicilio->ciudad ?? '--' }}" id="city" />

                <x-icon-cont
                    icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><g fill="none" stroke="#65a30d" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M11 21H4a2 2 0 0 1-2-2v-4.54a2 2 0 0 1 .963-1.71l3.5-2.122a2 2 0 0 1 2.074 0l3.5 2.121A2 2 0 0 1 13 14.46V19a2 2 0 0 1-2 2M6.5 10V6.46a2 2 0 0 1 .963-1.71l3.5-2.122a2 2 0 0 1 2.074 0l3.5 2.121a2 2 0 0 1 .963 1.71V10M16 21h4a2 2 0 0 0 2-2v-4.54a2 2 0 0 0-.963-1.71l-3.506-2.125a2 2 0 0 0-2.065-.005l-.633.38"/><path d="M9 21v-3.4a.6.6 0 0 0-.6-.6H6.6a.6.6 0 0 0-.6.6V21m12 0v-3.4a.6.6 0 0 0-.6-.6H16"/></g></svg>'
                    label="Colonia" text="{{ $Worker->domicilio->colonia ?? '--' }}" id="suburb" />

            </div>
            {{-- contenedor de la derecha  --}}
            <div class="col-12 col-md-6 col-xl-6">

                <x-icon-cont
                    icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 14 14"><path fill="none" stroke="#65a30d" stroke-linecap="round" stroke-linejoin="round" d="m.5 13.5l3-13M7 .5v2M7 6v2m0 3.5v2m6.5 0l-3-13"/></svg>'
                    label="Calle" text="{{ $Worker->domicilio->calle ?? '--' }}" id="street" />

                <div class="row">
                    <div class="form-group col-6">
                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="none" stroke="#65a30d" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 17V7l7 10V7m4 10h5m-5-7a2.5 3 0 1 0 5 0a2.5 3 0 1 0-5 0"/></svg>'
                            label="Número" text="{{ $Worker->domicilio->numero ?? '--' }}" id="number" />
                    </div>
                    <div class="form-group col-6">
                        <x-icon-cont
                            icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 8 8"><path fill="#65a30d" d="M3 1V0h1v1M3 8V5h1v3M1 4V2h5l1 1l-1 1"/></svg>'
                            label="Código postal" text="{{ $Worker->domicilio->cp ?? '--' }}" id="Person_Correo" />
                    </div>
                </div>

                <div class="col-12 d-lg-flex justify-content-end mt-3 ">

                    <div class="d-flex flex-column flex-lg-row gap-3">

                        <div data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="Ver detalles del domicilio">
                            <x-save-button-component text="Detalles" id="address-data" description="Ver detalles y editar datos"
                                href="{{ route('worker.detalles.edit-address', $Worker->id) }}" />
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
