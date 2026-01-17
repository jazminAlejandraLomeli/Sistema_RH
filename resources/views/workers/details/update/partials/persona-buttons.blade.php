{{-- Botones para el formulario de datos personales --}}

<div class="col-12 d-lg-flex justify-content-lg-end mt-3">
    <div class="d-flex flex-column flex-lg-row gap-3">


        <div class="flex-fill flex-lg-grow-0" data-bs-toggle="tooltip" data-bs-html="true"
            data-bs-title="Regresar a la vetana anterior">

            <x-back-button-component class="class-button-back"
                href="{{ route('worker.detalles.mostrar', $worker->id) }}" />
        </div>

        <div class="flex-fill flex-lg-grow-0" data-bs-toggle="tooltip" data-bs-html="true"
            data-bs-title="Guardar cambios">
            <x-save-button-component id="personal-data" />
        </div>
    </div>
</div>
