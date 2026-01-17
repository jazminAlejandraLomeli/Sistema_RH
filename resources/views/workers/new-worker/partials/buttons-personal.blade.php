   <div class="col-12 d-lg-flex justify-content-end mt-3 ">
       <div class="d-flex flex-column flex-lg-row gap-3">
        
           <div class="flex-fill flex-lg-grow-0" data-bs-toggle="tooltip" data-bs-html="true"
               data-bs-title="Cancelar acción">
               <x-delete-button-component text="Cancelar" href="{{ route('worker.index') }}" />
           </div>

           <div class="flex-fill flex-lg-grow-0" data-bs-toggle="tooltip" data-bs-html="true"
               data-bs-title="Limpiar formulario">
               <x-clear-button-component id="button-clear" />
           </div>

           <div class="flex-fill flex-lg-grow-0" data-bs-toggle="tooltip" data-bs-html="true"
               data-bs-title="Siguiente paso NOMBRAMIENTO">
               <x-next-button-component id="personal-data" />
           </div>

       </div>
   </div>
