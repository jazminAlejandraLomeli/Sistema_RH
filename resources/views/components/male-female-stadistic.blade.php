
@props(['tooltip' => ''])

<div class="col-12 col-md-4 col-xl-4 mb-4">
    <div class="card p-1 gender" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="{{ $tooltip  }}">
        <p class="text-center mb-1 fs-6 fw-bold"> {{ $title }}</p>
        <div
            class="row m-0 p-0  justify-content-between align-items-center border-bottom border-secondary border-opacity-25">

            <div class="col-auto pb-1">

                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 50 50">
                    <path fill="#0B5ED7"
                        d="M18 47c0 1.233.768 2 2 2c1.235 0 2-.767 2-2V28h2v19c0 1.231.767 2 2 2s2-.767 2-2V15h1v11.814c0 2.395 3.006 2.395 3 0V14.661C32 12.015 30.094 10 27 10h-8c-2.82 0-5 1.719-5 4.587V27c0 2 3 2 3 0V15h1z" />
                    <circle cx="22.875" cy="4.625" r="4.125" fill="#0B5ED7" />
                </svg>
                Masculino
            </div>

            <div class="col d-flex flex-column mb-1 align-items-end pt-1 text-muted ">
                <span class="pe-1 fw-semibold fs-4">
                    {{ $male }}

                </span>
            </div>
        </div>

        <div
            class="row m-0 p-0  justify-content-between align-items-center  border-bottom border-secondary border-opacity-25">
            <div class="col-auto">

                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 50 50">
                    <circle cx="22.875" cy="4.625" r="4.125" fill="#db2777" />
                    <path fill="#db2777"
                        d="m32.913 32l-5.909-16.237l-.034-.167c0-.237.199-.429.447-.429c.211 0 .388.141.435.329L31.869 26c.267.601 1.365 1 2.087 1c.965 0 1.065-1.895 1.044-2l-4.017-10.357C30.634 12.322 28.29 10 25.615 10H20.38c-2.675 0-5.193 2.322-5.542 4.643L11.001 25c-.087.199 0 2 1.043 2c.811 0 1.89-.283 2.087-1l3.875-10.549a.45.45 0 0 1 .421-.284c.247 0 .446.192.446.428l-.028.153L13.088 32c-.011.048 0 .951 0 1c0 .346.835 1 1.198 1H18v13.095c0 1.04.916 1.905 2 1.905s2-.866 2-1.905V33.991c0-.283 2-.274 2 .009v13c0 1.04.917 2 2 2c1.086 0 2-.961 2-2V34h3.869c.362 0 1.044-.654 1.044-1c0-.08.029-.931 0-1" />
                </svg>
                Femenino

            </div>
            <div class="col d-flex flex-column text-muted  mb-1 align-items-end pt-1">
                <span class="pe-1 fw-semibold fs-4">
                    {{ $female }}

                </span>

            </div>
        </div>

        <div class="row m-0 p-0  justify-content-between align-items-center" >
            <div class="col-auto">

                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48">
                    <path fill="#666666" fill-rule="evenodd"
                        d="M33.5 13a3.5 3.5 0 1 0 0-7a3.5 3.5 0 0 0 0 7m5.149 7c.05.352.093.729.132 1.122c.218 2.245.219 4.679.219 5.378a1.5 1.5 0 0 0 3 0v-.007c0-.707 0-3.264-.233-5.662c-.116-1.19-.297-2.43-.597-3.406c-.148-.479-.355-1.002-.671-1.436S39.59 15 38.689 15H28.31c-.901 0-1.493.555-1.81.99c-.316.433-.523.956-.67 1.435c-.3.976-.482 2.217-.598 3.406C25 23.229 25 25.786 25 26.493v.007a1.5 1.5 0 0 0 3 0c0-.7 0-3.133.22-5.378c.038-.393.082-.77.131-1.122H29v20.5a1.5 1.5 0 0 0 2.995.12l.85-10.62h1.31l.85 10.62A1.5 1.5 0 0 0 38 40.5V20zM18 9.5a3.5 3.5 0 1 1-7 0a3.5 3.5 0 0 1 7 0m.866 5.546a1.5 1.5 0 0 0-.366-.045h-8.002q-.185 0-.364.046c-1.114.28-1.862.959-2.333 1.885c-.413.812-.614 1.82-.78 2.823l-1 6a1.5 1.5 0 1 0 2.959.493l1-6c.092-.557.178-.982.265-1.31L10.5 22c0 1.87-1.694 10.408-2.293 13.37a.99.99 0 0 0 .823 1.177c4.122.614 6.818.595 10.939-.004a.99.99 0 0 0 .829-1.173C20.203 32.36 18.5 23.606 18.5 22l.255-3.062c.087.328.173.752.265 1.31l1 6a1.5 1.5 0 0 0 2.96-.494l-1-6c-.167-1.002-.368-2.011-.78-2.822c-.471-.927-1.22-1.605-2.334-1.886m-7.858 26.078l-.377-3.013c1.06.13 2.067.215 3.059.253l-.72 2.879a1 1 0 0 1-1.962-.119m5.022.118l-.714-2.857a35 35 0 0 0 3.04-.174l-.364 2.913a1 1 0 0 1-1.962.118"
                        clip-rule="evenodd" />
                </svg>
                Total

            </div>
            <div class="col d-flex flex-column text-muted  mb-1 align-items-end pt-1">
                <span class="pe-1 fw-semibold fs-4">
                    {{ $total }}

                </span>

            </div>
        </div>
    </div>
</div>


{{--     
    <div class="col-sm-6 col-md-3 col-xl-3 card d-flex flex-column align-items-center mt-1">
         <div class="text-cont">
             <p class="mb-0 fst-italic text-center ">
                  <span >Núm. de <b>{{ $title }}</b></span>
             </p>
         </div>
         <div class="row col-12 mb-0">
             <div class="col-6 d-flex justify-content-center ">

                 <div class="cont-icon">
                     <div tabindex="0" class="rounded-icon gb-card1 mt-1">
                         <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 50 50">
                             <path fill="#0B5ED7"
                                 d="M18 47c0 1.233.768 2 2 2c1.235 0 2-.767 2-2V28h2v19c0 1.231.767 2 2 2s2-.767 2-2V15h1v11.814c0 2.395 3.006 2.395 3 0V14.661C32 12.015 30.094 10 27 10h-8c-2.82 0-5 1.719-5 4.587V27c0 2 3 2 3 0V15h1z" />
                             <circle cx="22.875" cy="4.625" r="4.125" fill="#0B5ED7" />
                         </svg>
                     </div>
                     <p class="text-muted text-center mb-0 pb-0"> {{ $male }}</p>
                 </div>
             </div>

             <div class="col-6 d-flex justify-content-center">

                 <div class="cont-icon">
                     <div tabindex="0" class="rounded-icon gb-card2 mt-1">
                         <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 50 50">
                             <circle cx="22.875" cy="4.625" r="4.125" fill="#db2777" />
                             <path fill="#db2777"
                                 d="m32.913 32l-5.909-16.237l-.034-.167c0-.237.199-.429.447-.429c.211 0 .388.141.435.329L31.869 26c.267.601 1.365 1 2.087 1c.965 0 1.065-1.895 1.044-2l-4.017-10.357C30.634 12.322 28.29 10 25.615 10H20.38c-2.675 0-5.193 2.322-5.542 4.643L11.001 25c-.087.199 0 2 1.043 2c.811 0 1.89-.283 2.087-1l3.875-10.549a.45.45 0 0 1 .421-.284c.247 0 .446.192.446.428l-.028.153L13.088 32c-.011.048 0 .951 0 1c0 .346.835 1 1.198 1H18v13.095c0 1.04.916 1.905 2 1.905s2-.866 2-1.905V33.991c0-.283 2-.274 2 .009v13c0 1.04.917 2 2 2c1.086 0 2-.961 2-2V34h3.869c.362 0 1.044-.654 1.044-1c0-.08.029-.931 0-1" />
                         </svg>
                     </div>
                     <p class="text-muted text-center  mb-0 pb-0"> {{ $female }}</p>
                 </div>
             </div>
         </div>
         <div class="col-12 text-center mt-0 mb-1">
             <span class="fw-normal"><i>Total: <b> {{ $total }} </b></i></span>
         </div>
     </div> --}}
