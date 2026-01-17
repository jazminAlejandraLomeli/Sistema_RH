 {{-- Botones del formulario --}}
 <div class="col-12 d-lg-flex justify-content-lg-end mt-3">
     <div class="d-flex flex-column flex-lg-row gap-3">

         <div class="flex-fill flex-lg-grow-0">
             <x-back-button-component class="class-button-back"
                 href="{{ route('worker.detalles.mostrar', $Worker->id) }}" />
         </div>


         <div class="flex-fill flex-lg-grow-0" data-bs-toggle="tooltip" data-bs-html="true"
             data-bs-title="Eliminar nombramiento principal">
             <x-delete-button-component id="delete-job" data-id-work="{{ $Data->id }}" />
         </div>

         <div class="flex-fill flex-lg-grow-0" data-bs-toggle="tooltip" data-bs-html="true"
             data-bs-title="Guardar cambios del nombramiento">
             <x-save-button-component id="confirm-register" />
         </div>

     </div>
 </div>
