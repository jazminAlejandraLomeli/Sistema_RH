<div class="modal fade" id="birthdays" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content px-2">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

 

           <!-- Aquí va el body de Livewire -->
            <div class="modal-body">
                @livewire('birthdays-modal', ['month' =>  $birthdays['month_number']])
            </div>

            <div class="modal-footer d-flex justify-content-center">
                <div class="flex-fill flex-lg-grow-0">
                    <x-delete-button-component text="Cerrar" data-bs-dismiss="modal" />
                </div>
            </div>

        </div>
    </div>
</div>
