<div class="row mt-3 mb-4 card animate__animated animate__fadeInDown p-3 mw-75 mx-auto">
    <x-section-divider text="{{ $Title }}" color="#0284c7" />
    <div class="row mt-3 px-0 ">

        <div class="col-12 col-md-4 col-xl-4 d-flex justify-content-center">
            <x-icon-cont
                icon=' <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                 <g fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="1.5" color="#373CC4">
                                     <path
                                         d="M8.5 18c1.813-1.954 5.167-2.046 7 0m-1.56-6c0 1.105-.871 2-1.947 2c-1.075 0-1.947-.895-1.947-2s.872-2 1.947-2s1.948.895 1.948 2" />
                                     <path
                                         d="M9.5 4.002c-2.644.01-4.059.102-4.975.97C3.5 5.943 3.5 7.506 3.5 10.632v4.737c0 3.126 0 4.69 1.025 5.66c1.025.972 2.675.972 5.975.972h3c3.3 0 4.95 0 5.975-.971c1.025-.972 1.025-2.535 1.025-5.66v-4.738c0-3.126 0-4.689-1.025-5.66c-.916-.868-2.33-.96-4.975-.97" />
                                     <path
                                         d="M9.772 3.632c.096-.415.144-.623.236-.792a1.64 1.64 0 0 1 1.083-.793C11.294 2 11.53 2 12 2s.706 0 .909.047a1.64 1.64 0 0 1 1.083.793c.092.17.14.377.236.792l.083.36c.17.735.255 1.103.127 1.386a1.03 1.03 0 0 1-.407.451C13.75 6 13.332 6 12.498 6h-.996c-.834 0-1.252 0-1.533-.17a1.03 1.03 0 0 1-.407-.452c-.128-.283-.043-.65.127-1.386z" />
                                 </g>
                             </svg>'
                label="Código" text="{{ $Worker->codigo }}" id="Person_Code" />
        </div>
        <div class="col-12 col-md-4 col-xl-4 d-flex justify-content-center">
            <x-icon-cont
                icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="none" stroke="#373CC4" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20.75a1 1 0 0 0 1-1v-1.246c.004-2.806-3.974-5.004-8-5.004s-8 2.198-8 5.004v1.246a1 1 0 0 0 1 1zM15.604 6.854a3.604 3.604 0 1 1-7.208 0a3.604 3.604 0 0 1 7.208 0"/></svg>'
                label="Nombre Completo" text="{{ $Worker->nombre }}" id="Person_Name" />

        </div>
        <div class="col-12 col-md-4 col-xl-4 d-flex justify-content-center">
            @if ($Worker->sexo == 'Femenino')
                <x-icon-cont
                    icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#c026d3" d="M12 4a6 6 0 0 1 6 6c0 2.97-2.16 5.44-5 5.92V18h2v2h-2v2h-2v-2H9v-2h2v-2.08c-2.84-.48-5-2.95-5-5.92a6 6 0 0 1 6-6m0 2a4 4 0 0 0-4 4a4 4 0 0 0 4 4a4 4 0 0 0 4-4a4 4 0 0 0-4-4"/></svg>'
                    label="Género" text="{{ $Worker->sexo }}" id="Person_sex" />
            @else
                <x-icon-cont
                    icon='<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#4f46e5" d="M9 9c1.29 0 2.5.41 3.47 1.11L17.58 5H13V3h8v8h-2V6.41l-5.11 5.09c.7 1 1.11 2.2 1.11 3.5a6 6 0 0 1-6 6a6 6 0 0 1-6-6a6 6 0 0 1 6-6m0 2a4 4 0 0 0-4 4a4 4 0 0 0 4 4a4 4 0 0 0 4-4a4 4 0 0 0-4-4"/></svg>'
                    label="Género" text="{{ $Worker->sexo }}" id="Person_sex" />
            @endif


        </div>
        <input type="hidden" value="{{ $gender }}" id="person_sex" class="d-none">

    </div>
</div>
