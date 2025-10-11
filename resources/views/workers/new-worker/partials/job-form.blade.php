 <div class="card job-data d-none">
     <h5 class="card-header bg-blue-primary text-white text-center">Datos del nombramiento principal</h5>
     <div class="card-body">

         <p class="mb-0 pb-0 fw-light"> Ingresa los datos pertenecientes al nombramiento, y una vez
             verificados, haz clic en <i>guardar</i>.
         </p>


         <div class="row mt-2">
             <div class="col-12 col-md-6 col-xl-6">

                 <x-select id="nombramientos" label="Nombramiento" name="nombramientos" :options="['' => 'Selecciona un nombramiento'] + $nombramientos->pluck('nombre', 'id')->toArray()"
                     requiredIndicator="true" />

                 <label class="mt-2" for="categorias" style="display: block;">Categoría <span
                         class="red-Color">*</span></label>
                 <select disabled="disabled" class="form-control form-disabled categorias" name="categorias" >
                     <option value="" disabled selected>Selecciona una opción</option>
                 </select>
                 <span class="text-danger fw-normal" style=" display: none;">Categoría no
                     válida.</span>

                 <!-- Este campo estará oculto a no ser que el, nombramiento si tenga deisticiosn adiciinal -->
                 <div class="form-group d-none campo-distincion mt-2">
                     <label for="Distincion_Adicional">Distincion adicional:</label>
                     <select class="form-control form-disabled Distincion_Adicional" name="Distincion_Adicional" id="Distincion_Adicional">
                         <option value="" disabled selected>Selecciona una opción</option>
                     </select>
                     <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                 </div>

                 <x-input  class="dep" id="dep" label="Departamento /Área de Adscripción" name="dep"
                     requiredIndicator="true" disableIndicator="true" />


             </div>
             <div class="col-12 col-md-6 col-xl-6 ">
                 <div class="row">
                     <div class="col-6">
                         @php
                             // Mapear el grado
                             $Hours = collect([
                                 ['id' => 1, 'nombre' => '20'],
                                 ['id' => 2, 'nombre' => '24'],
                                 ['id' => 3, 'nombre' => '36'],
                                 ['id' => 4, 'nombre' => '40'],
                                 ['id' => 5, 'nombre' => '48'],
                                 ['id' => 6, 'nombre' => 'Carga 0'],
                                 ['id' => 7, 'nombre' => 'No aplica'],
                             ]);

                         @endphp

                         <x-select id="hours" label="Horas de trabajo" name="hours" :options="['' => 'Selecciona las horas'] + $Hours->pluck('nombre', 'id')->toArray()"
                             requiredIndicator="true" disableIndicator="true" />
                     </div>
                     <div class="col-6">
                         @php
                             // Mapear el grado
                             $Shifts = collect([
                                 ['id' => 1, 'nombre' => 'Matutino'],
                                 ['id' => 2, 'nombre' => 'Vespertino'],
                                 ['id' => 3, 'nombre' => 'Nocturno'],
                                 ['id' => 4, 'nombre' => 'Mixto'],
                                 ['id' => 5, 'nombre' => 'No aplica'],
                             ]);

                         @endphp

                         <x-select id="shift" label="Turno" name="shift" :options="['' => 'Selecciona un turno'] + $Shifts->pluck('nombre', 'id')->toArray()"
                             requiredIndicator="true" disableIndicator="true" />

                     </div>
                 </div>

                 <div class="row">
                     <div class="col-6">

                         @php
                             // Mapear el grado
                             $Contrato = collect([
                                 ['id' => 1, 'nombre' => 'Temporal'],
                                 ['id' => 2, 'nombre' => 'Interinato'],
                                 ['id' => 3, 'nombre' => 'Definitivo'],
                             ]);

                         @endphp

                         <x-select id="contrato" label="Tipo de contrato" name="contrato" :options="['' => 'Selecciona un tipo'] + $Contrato->pluck('nombre', 'id')->toArray()"
                             requiredIndicator="true" disableIndicator="true" />

                     </div>

                     <div class="col-6">
                         <div class="Contrato">
                             <x-input type="date" id="fecha_termino" class="fecha_termino" label="F. de termino" name="fecha_termino"
                                 requiredIndicator="true" disableIndicator="true" />

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
                     <textarea class="form-control form-disabled" aria-label="With textarea" name="hor_oficial" id="hor_oficial" disabled></textarea>
                 </div>


             </div>
         </div>


         <div class="col-12 d-none extras-container">
             <hr class="mt-3" />
             <p class="pt-1 mb-0 text-center  instructions">Selecciona los departamentos a los cuales impartirá clases
                 y escribe la semblanza del profesor en caso de ya tener una.</p>

             {{-- <div class="col d-flex justify-content-end mt-2 mb-0 pb-0">
                 <a data-bs-toggle="tooltip" data-bs-html="true"
                     data-bs-title="Semblanza es una breve descripción sobre la trayectoria del profesor(a) ">
                     <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 16 16">
                         <path fill="#0891b2" fill-rule="evenodd"
                             d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M4.927 4.99Q4.5 5.634 4.5 6.26q0 .305.27.566t.661.26q.665 0 .903-.746q.252-.713.616-1.08q.364-.366 1.134-.366q.658 0 1.075.363q.416.364.416.892a.97.97 0 0 1-.136.502a2 2 0 0 1-.336.419a14 14 0 0 1-.648.558q-.51.423-.812.73q-.3.308-.483.713c-.322 1.245 1.35 1.345 1.736.456q.07-.128.213-.284q.144-.155.382-.36a41 41 0 0 0 1.194-1.034q.332-.306.573-.73a1.95 1.95 0 0 0 .242-.984q0-.712-.424-1.32q-.423-.609-1.2-.962T8.084 3.5q-1.092 0-1.911.423T4.927 4.989Zm2.14 7.08a1 1 0 1 0 2 0a1 1 0 0 0-2 0"
                             clip-rule="evenodd" />
                     </svg> </a>
             </div> --}}

             <div class="row mt-3 ">

                 <div class="col-12 col-md-6 col-xl-6 d-none cont-departament">
                     <x-select id="department" label="Departamento" name="departments[]" :options="['' => 'Selecciona los departamentos'] +
                         $departamentos->pluck('nombre', 'id')->toArray()"
                         requiredIndicator="true" />
                 </div>


                 <div class="col-12 col-md-6 col-xl-6 d-none cont-semblanza">
                     <label for="hor_oficial">Semblanza </label>
                     <div class="grow-wrap">
                         <textarea class="form-control form-disabled" aria-label="With textarea" name="semblanza" id="semblanza"
                             placeholder="Escribe la semblanza"></textarea>
                     </div>
                 </div>
             </div>

         </div>

         {{-- Botones del formulario --}}
         <div class="col-12 d-lg-flex justify-content-lg-end mt-3">
             <div class="d-flex flex-column flex-lg-row gap-3">
                 <a class="btn fst-italic  animated-icon button-cancel cancel"> <i class="pe-2 fa-solid fa-xmark"></i>
                     Cancelar</a>


                 <button class="btn fst-italic  animated-icon  button-add" id="confirm-register"> Guardar
                     <i class="fa-regular fa-circle-check px-1"></i></button>
             </div>


         </div>


     </div>
 </div>
