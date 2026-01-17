   <div class="col-12 d-lg-flex justify-content-end mt-3 ">
       <div class="d-flex flex-column flex-lg-row gap-3">

           <div class="flex-fill flex-lg-grow-0" data-bs-toggle="tooltip" data-bs-html="true"
               data-bs-title="Cancelar acción">
               <x-delete-button-component class="class-button-back" text="Cancelar" href="{{ $route }}" />

           </div>

           <div class="flex-fill flex-lg-grow-0" data-bs-toggle="tooltip" data-bs-html="true"
               data-bs-title="Guardar cambios">
               <x-save-button-component id="confirm-register" />
           </div>
       </div>
   </div>
