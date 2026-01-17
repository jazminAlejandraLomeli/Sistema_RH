 <div class="card ">
     <h5 class="card-header bg-blue-primary text-white text-center">Datos del nombramiento</h5>
     <div class="card-body">

         <p class="mb-0 pb-0 fw-light"> Actualiza los datos que han camb, haz clic en <i>guardar</i>.
         </p>


         <div class="row mt-2">
             <div class="col-12 col-md-6 col-xl-6">

                 <x-select id="nombramientos" label="Nombramiento" name="nombramientos" :options="['' => 'Selecciona un nombramiento'] + $nombramientos->pluck('nombre', 'id')->toArray()"
                     requiredIndicator="true" selected="{{ $Data->nombramiento }}" />



                 <x-select id="categorias" label="Categoría" name="categorias" :options="['' => 'Selecciona un categoria'] + $categorias->pluck('nombre', 'id')->toArray()"
                     requiredIndicator="true" selected="{{ $Data->id_categoria }}" />

                 <span class="text-danger fw-normal" style=" display: none;">Categoría no
                     válida.</span>


                 <div class="form-group {{ $Data->distincion_ad == null ? 'd-none' : '' }} campo-distincion mt-2">
                     <x-select id="Distincion_Adicional" label="Distincion Adicional" name="Distincion_Adicional"
                         :options="['' => 'Distinción adicional'] + $Distinciones->pluck('nombre', 'id')->toArray()" selected="{{ $Data->distincion_ad }}" />
                 </div>

                 <x-input class="dep" id="dep" label="Departamento /Área de Adscripción" name="dep"
                     requiredIndicator="true" value="{{ $Data->area_distincion }}" />

                 <x-select id="status" label="Estado del nombramiento" name="status" :options="['' => 'Selecciona un estado'] + $Estados->pluck('nombre', 'id')->toArray()"
                     selected="{{ $Data->id_estado }}" />

             </div>


             <div class="col-12 col-md-6 col-xl-6 ">
                 <div class="row">
                     <div class="col-6">
                         @php

                             $Hours = collect(config('work-collections.Hours'));
                             // Buscar el id correspondiente al texto
                             $selectedHourId = optional($Hours->firstWhere('nombre', $Data->horas_trabajo))['id'];
                         @endphp

                         <x-select id="hours" label="Horas de trabajo" name="hours" :options="['' => 'Selecciona las horas'] + $Hours->pluck('nombre', 'id')->toArray()"
                             requiredIndicator="true" selected="{{ $selectedHourId }}" />

                     </div>
                     <div class="col-6">
                         @php
                             $Shifts = collect(config('work-collections.Shifts'));
                             $selectedShiftId = optional($Shifts->firstWhere('nombre', $Data->turno))['id'];

                         @endphp
                         <x-select id="shift" label="Turno" name="shift" :options="['' => 'Selecciona un turno'] + $Shifts->pluck('nombre', 'id')->toArray()"
                             requiredIndicator="true" selected="{{ $selectedShiftId }}" />

                     </div>
                 </div>

                 <div class="row">
                     <div class="col-6">

                         @php
                             $Contrato = collect(config('work-collections.Contracts'));
                             $selectedContractId = optional($Contrato->firstWhere('nombre', $Data->tipo_contrato))[
                                 'id'
                             ];
                         @endphp

                         <x-select id="contrato" label="Tipo de contrato" name="contrato" :options="['' => 'Selecciona un tipo'] + $Contrato->pluck('nombre', 'id')->toArray()"
                             requiredIndicator="true" selected="{{ $selectedContractId }}" />

                     </div>

                     <div class="col-6">
                         <div class="Contrato">
                             <x-input type="date" id="fecha_termino" class="fecha_termino" label="F. de termino"
                                 name="fecha_termino" requiredIndicator="true" value="{{ $Data->fecha_termino }}" />

                         </div>
                     </div>
                 </div>

                 <div class="col d-flex justify-content-end mt-2 mb-0 pb-0">
                     <a data-bs-toggle="tooltip" data-bs-html="true"
                         data-bs-title="Separa los días con una <em>coma</em> <b>(,)</b> para su mejor visualización">
                         <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48">
                             <circle cx="24" cy="24" r="21" fill="#2196F3" />
                             <path fill="#fff" d="M22 22h4v11h-4z" />
                             <circle cx="24" cy="16.5" r="2.5" fill="#fff" />
                         </svg>
                     </a>
                 </div>


                 <label for="hor_oficial">Horario oficial: <span class="red-Color opc">*</span></label>
                 <div class="grow-wrap">
                     <textarea class="form-control form-disabled" aria-label="With textarea" name="hor_oficial" id="hor_oficial">{{ $Data->horario_oficial }}</textarea>
                 </div>


             </div>
         </div>

         <div
             class="col-12 {{ $Data->nombramiento >= 1 && $Data->nombramiento <= 3 ? 'd-none' : '' }}  extras-container">
             <hr class="mt-3" />
             <p class="pt-1 mb-0 text-center instructions">Selecciona los departamentos a los cuales impartirá clases
                 y escribe la semblanza del profesor en caso de ya tener una.</p>

             <div class="row mt-3 ">

                 <div
                     class="col-12 col-md-6 col-xl-6{{ $Data->departamento != null ? 'd-none' : '' }} cont-departament">

                     @php
                         // Extrae solo los IDs de los departamentos asociados
                         $selectedDepartments = $Data->departamento->pluck('id')->toArray();
                     @endphp


                     <x-select id="department" label="Departamento" name="departments[]" :options="$departamentos->pluck('nombre', 'id')->toArray()"
                         :selected="$selectedDepartments" requiredIndicator="true" />
                 </div>


                 <div class="col-12 col-md-6 col-xl-6 d-non cont-semblanza mt-2">
                     <label for="hor_oficial">Semblanza </label>
                     <div class="grow-wrap">
                         <textarea class="form-control form-disabled" aria-label="With textarea" name="semblanza" id="semblanza"
                             placeholder="Escribe la semblanza"> {{ $Data->semblanza ?? '' }}</textarea>
                     </div>
                 </div>
             </div>
         </div>

         @include('workers.details.update.partials.job-buttons')
     </div>



 </div>
 