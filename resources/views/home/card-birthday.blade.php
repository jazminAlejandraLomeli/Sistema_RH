   {{-- Card para los cumpleañeros --}}

   <div class="col-sm-6 col-md-4 col-xl-4 px-3 mb-4">
       <div class="card h-100 shadow-lg border-0 rounded-4 overflow-hidden position-relative card-hbd">
           <div class="card-body d-flex flex-column align-items-center justify-content-center p-1">
               <div class="position-absolute top-0 start-0 w-100 h-100"
                   style="background: linear-gradient(135deg, rgba(71,110,174,0.1) 0%, rgba(71,110,174,0.05) 100%); z-index: 0; ">
               </div>

               <div class="text-center mb-0 position-relative z-1">
                   <p class="mb-0 fs-5 text-dark">
                       <span class="fw-normal">Cumpleañeros de <span
                               class="fw-bold fst-italic text-primary">{{ $birthdays['name_month'] }}</span></span>
                   </p>
               </div>

               <div class="cont-icon pt-1 mb-2 position-relative z-1">
                   <div tabindex="0"
                       class="animate__animated animate__shakeX animate__bounce animate__delay-3s mt-1 show-details p-3 rounded-circle bg-white shadow-sm ">
                       <button class="modal-btn" data-bs-toggle="modal" data-bs-target="#birthdays">
                        <x-confetty-component type="Cake" ></x-confetty-component>
                       </button>
                   </div>
               </div>

               <div class="col-12 text-center position-relative z-1">
                   <span class="pt-2 pb-3 fs-2 fw-bolder text-primary lh-1">{{ $birthdays['count'] ?? 0 }}</span>

               </div>
           </div>
       </div>
   </div>


