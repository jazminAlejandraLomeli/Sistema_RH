 {{-- Vista para agregar a una persona nueva al sistema  --}}
 @extends('admin.layouts.main')
 @section('title', 'Agregar')

 @section('viteConfig')
     @vite(['resources/sass/StyleForm.scss'])
 @endsection
 @section('titleView', 'Agregar una persona al sistema')

 @section('content')
     <div class="container ">

         @include('admin.new-worker.partials.personal-data-form')
         <br>
         
         @include('admin.new-worker.partials.job-form')
         <br><br>
         {{-- <div class="row justify-content-center Personal-Data">
             <div class="row col-12 bg-color-form">
                 <div class="row mt-3 mb-2">
                      <div class="col-lg-6 col-sm-12">
                         <div class="form-group">
                             <div class="row pt-2">
                                 <div class="form-group col-md-6 col-sm-12">
                                     <label for="codigo"> Código <span class="red-Color">*</span></label>
                                     <input class="form-control" type="text" id="codigo" name="codigo"
                                         pattern="[0-9]{7}" maxlength="7">
                                     <span class="text-danger fw-normal" style=" display: none;">Código no válido.</span>
                                 </div>
                                 <div class="form-group col-md-6 col-sm-12">
                                     <label for="sex">Género <span class="red-Color">*</span></label>
                                     <select class="form-control" name="sex" id="sex">
                                         <option value="" disabled selected>Seleccione una opción</option>
                                         <option value="1">Masculino</option>
                                         <option value="2">Femenino</option>
                                     </select>
                                     <span class="text-danger fw-normal" style=" display: none;">Género no válido.</span>
                                 </div>
                             </div>
                         </div>
                         <div class="form-group pt-2 col-12">
                             <label for="name_P">Nombre Completo <span class="red-Color">*</span></label>
                             <input class="form-control" type="text" name="name_P" id="name_P"
                                 oninput="this.value = this.value.toUpperCase()">
                             <span class="text-danger fw-normal" style=" display: none;">Nombre no válido.</span>

                         </div>
                         <div class="form-group pt-2 col-12">
                             <label for="correo">Correo electrónico</label>
                             <input type="text" id="correo" class="form-control" />
                             <span class="text-danger fw-normal" style=" display: none;">Correo no válido.</span>
                         </div>
                     </div>
                      <div class="col-lg-6 col-sm-12">
                         <div class="form-group">
                             <div class="row pt-2">
                                 <div class="form-group col-md-6 col-sm-12">
                                     <label for="fecha_nacimiento">F. de nacimiento <span class="red-Color">*</span></label>
                                     <input class="form-control" type="date" id="fecha_nacimiento"
                                         name="fecha_nacimiento">
                                     <span class="text-danger fw-normal" style=" display: none;">Fecha de nacimiento no
                                         válida.</span>
                                 </div>
                                 <div class="form-group col-md-6 col-sm-12">
                                     <label for="fecha_ingreso">F. de ingreso a UDG <span class="red-Color">*</span></label>
                                     <input class="form-control" type="date" id="fecha_ingreso" name="fecha_ingreso">
                                     <span class="text-danger fw-normal" style=" display: none;">Fecha de ingreso no
                                         válida.</span>
                                 </div>
                             </div>
                         </div>
                         <div class="form-group pt-2 col-12">
                             <label for="grade">Grado de estudios <span class="red-Color">*</span></label>
                             <select class="form-control" name="grade" id="grade">
                                 <option value="" disabled selected>Seleccione una opción</option>
                                 <option value="1">Primaria</option>
                                 <option value="2">Secundaria</option>
                                 <option value="3">Bachillerato</option>
                                 <option value="4">Carrera técnica</option>
                                 <option value="5">Licenciatura/Ingeniería</option>
                                 <option value="6">Especialidad</option>
                                 <option value="7">Maestría</option>
                                 <option value="8">Doctorado</option>
                             </select>
                             <span class="text-danger fw-normal" style=" display: none;">Grado de estudios no válido.</span>
                         </div>
                         <div class="form-group">
                             <div class="row pt-2">
                                 <div class="form-group col-md-6 col-sm-12">
                                     <label for="tel">Tel. de emergencia: </label>
                                     <input type="text" id="tel" class="form-control" maxlength="10" />
                                     <span class="text-danger fw-normal" style=" display: none;">Teléfono no válido.</span>
                                 </div>
                                 <div class="form-group col-md-6 col-sm-12">
                                     <label for="tel">Nombre</label>
                                     <input type="text" id="Emer_name" class="form-control" />
                                     <span class="text-danger fw-normal" style=" display: none;">Nombre no válido.</span>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="row mt-2 justify-content-end text-end mb-3">
                     <div class="col-6">
                         <a class="btn fst-italic  animated-icon button-cancel back"> <i
                                 class="pe-2 fa-solid fa-xmark"></i> Cancelar</a>
                         <button class="btn fst-italic  animated-icon  button-save" id="personal-data"> Siguiente <i
                                 class="ps-2 fa-solid fa-arrow-right"></i></button>
                     </div>
                 </div>
             </div>
         </div> --}}


         <!-- Formulario para los datos del nombramiento principal  -->
         {{-- <div class="job-data">
             <h5 class="text-center">Datos del nombramiento principal</h5>
             <p class="pt-1 mb-0">Escribe los datos correspondientes a el nombramiento principal de la persona.</p>
             <div class="row justify-content-center ">
                 <div class="row col-12 bg-color-form">
                     <div class="row mt-3 mb-2">
                         <div class="col-lg-6 col-sm-12">
                             <div class="form-group">
                                 <div class="row pt-2">
                                     <div class="form-group col-12">
                                         <label for="nombramientos">Nombramiento <span class="red-Color">*</span>
                                         </label>
                                         <select class="form-control" name="nombramientos" id="nombramientos">
                                             <option value="" disabled selected>Selecciona una opción</option>
                                             @foreach ($nombramientos as $nombramiento)
                                                 <option value="{{ $nombramiento->id }}">{{ $nombramiento->nombre }}
                                                 </option>
                                             @endforeach
                                         </select>
                                         <span class="text-danger fw-normal" style=" display: none;">Nombramiento
                                             no válido.</span>
                                     </div>
                                 </div>
                             </div>
                             <div class="form-group pt-2 col-12">
                                 <label for="categoria" style="display: block;">Categoría <span
                                         class="red-Color">*</span></label>
                                 <select disabled="disabled" class="form-control form-disabled" name="categorias"
                                     id="categorias">
                                     <option value="" disabled selected>Selecciona una opción</option>
                                 </select>
                                 <span class="text-danger fw-normal" style=" display: none;">Categoría no
                                     válida.</span>
                             </div>
                             <div class="form-group pt-2 col-12 d-none campo-distincion">
                                 <label for="Distincion_Adicional">Distincion adicional:</label>
                                 <select class="form-control form-disabled" name="Distincion_Adicional"
                                     id="Distincion_Adicional">
                                     <option value="" disabled selected>Selecciona una opción</option>
                                 </select>
                                 <span class="text-danger fw-normal" style=" display: none;">Dato no
                                     válido.</span>
                             </div>
                             <div class="form-group pt-2 col-12">
                                 <label for="dep">Departamento /Área de Adscripción <span
                                         class="red-Color">*</span></label>
                                 <input class="form-control form-disabled" type="text" name="dep" id="dep"
                                     disabled>
                                 <span class="text-danger fw-normal" style=" display: none;">Departamento
                                     no válido.</span>
                             </div>
                         </div>
                         <div class="col-lg-6 col-sm-12">
                             <div class="form-group">
                                 <div class="row pt-2">
                                     <div class="form-group col-md-6 col-sm-12">
                                         <label for="hours">Horas de trabajo <span class="red-Color opc">*</span>
                                         </label>
                                         <select disabled class="form-control form-disabled" name="hours"
                                             id="hours">
                                             <option value="" disabled selected>Seleccione una opción
                                             </option>
                                             <option value="1">20</option>
                                             <option value="2">24</option>
                                             <option value="3">36</option>
                                             <option value="4">40</option>
                                             <option value="5">48</option>
                                             <option value="6">No aplica</option>
                                             <option value="7">Carga 0</option>
                                         </select>
                                         <span class="text-danger fw-normal" style=" display: none;">Horas
                                             no válidas.</span>
                                     </div>
                                     <div class="form-group col-md-6 col-sm-12">
                                         <label for="shift">Turno <span class="red-Color opc">*</span></label>
                                         <select disabled class="form-control form-disabled" name="shift"
                                             id="shift">
                                             <option value="" disabled selected>Seleccione una opción
                                             </option>
                                             <option value="1">Matutino</option>
                                             <option value="2">Vespertino</option>
                                             <option value="3">Nocturno</option>
                                             <option value="4">Mixto</option>
                                             <option value="5">No aplica</option>
                                         </select>
                                         <span class="text-danger fw-normal" style=" display: none;">Turno
                                             no válido.</span>
                                     </div>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <div class="row pt-2">
                                     <div class="form-group col-12">
                                         <label for="hor_oficial">Horario oficial: <span class="red-Color opc">*</span>
                                         </label>
                                         <textarea disabled class="form-control form-disabled" aria-label="With textarea" name="hor_oficial" id="hor_oficial"
                                             placeholder="Lunes de 08:00 - 15:00, Martes de 10:00 - 19:00"></textarea>
                                         <span class="text-danger fw-normal" style=" display: none;">Horario no
                                             válido.</span>
                                     </div>
                                 </div>
                             </div>
                             <div class="row pt-2">
                                 <div class="form-group col-md-6 col-sm-12">
                                     <label for="contrato">Tipo de contrato <span class="red-Color">*</span></label>
                                     <select disabled class="form-control form-disabled" name="contrato" id="contrato">
                                         <option value="" disabled selected>Seleccion euna opción
                                         </option>
                                         <option value="1">Temporal</option>
                                         <option value="2">Interinato</option>
                                         <option value="3">Definitivo</option>
                                     </select>
                                     <span class="text-danger fw-normal" style=" display: none;">Tipo
                                         no válido.</span>
                                 </div>
                                 <div class="form-group col-md-6 col-sm-12 Contrato d-none">
                                     <label for="fecha_termino" style="display: block;">Fecha de
                                         termino <span class="red-Color">*</span></label>
                                     <input disabled class="form-control form-disabled" type="date" id="fecha_termino"
                                         name="fecha_termino">
                                     <span class="text-danger fw-normal" style=" display: none;">Fecha
                                         no válida.</span>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="row mt-2 justify-content-end text-end mb-3">
                         <div class="col-6">
                             <a class="btn fst-italic  animated-icon button-cancel cancel"> <i
                                     class="pe-2 fa-solid fa-xmark"></i> Cancelar</a>
                             <button class="btn fst-italic  animated-icon  button-add" id="confirm-register"> Guardar
                                 <i class="fa-regular fa-circle-check px-1"></i></button>
                         </div>
                     </div>
                 </div>
             </div>
         </div> --}}
     @endsection

     @section('scripts')
         @vite('resources/js/new-worker/new-worker.js')
     @endsection