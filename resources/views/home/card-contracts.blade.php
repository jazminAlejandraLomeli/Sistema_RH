<div class="row mb-3">


    <p class="text-start pb-2 mb-0 mt-2 fs-5  ">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 22 22">
            <path fill="#0284c7" d="M9 5H8v12h1v-1h1v-1h1v-1h1v-1h1v-1h1v-2h-1V9h-1V8h-1V7h-1V6H9" />
        </svg>
        <i> Detalles de los tipos <b>Contratos</b> </i>

    </p>

    <div class="col-12 col-md-4 col-xl-4 mb-3">
        <div class="card p-1 ">
            <p class="text-center mb-1 fs-5"> Tipos de <b>contratos</b></p>
            <div
                class="row m-0 p-0  justify-content-between align-items-center border-bottom border-secondary border-opacity-25">

                <div class="col-auto pb-1">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="#059669" d="M12 7a5 5 0 1 1-4.995 5.217L7 12l.005-.217A5 5 0 0 1 12 7" />
                    </svg>
                    Definitivos
                </div>

                <div class="col d-flex flex-column mb-1 align-items-end pt-1 text-muted ">
                    <span class="pe-1 fw-semibold fs-4">
                        {{ $CountContracts['Definitivo']['Total'] ?? 0 }}

                    </span>
                </div>
            </div>

            <div
                class="row m-0 p-0  justify-content-between align-items-center  border-bottom border-secondary border-opacity-25">
                <div class="col-auto">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="#0284c7" d="M12 7a5 5 0 1 1-4.995 5.217L7 12l.005-.217A5 5 0 0 1 12 7" />
                    </svg>
                    Temporal

                </div>
                <div class="col d-flex flex-column text-muted  mb-1 align-items-end pt-1">
                    <span class="pe-1 fw-semibold fs-4">
                        {{ $CountContracts['Temporal']['Total'] ?? 0 }}

                    </span>

                </div>
            </div>

            <div class="row m-0 p-0  justify-content-between align-items-center">
                <div class="col-auto">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="#ea580c" d="M12 7a5 5 0 1 1-4.995 5.217L7 12l.005-.217A5 5 0 0 1 12 7" />
                    </svg>
                    Interinato

                </div>
                <div class="col d-flex flex-column text-muted  mb-1 align-items-end pt-1">
                    <span class="pe-1 fw-semibold fs-4">
                        {{ $CountContracts['Interinato']['Total'] ?? 0}}

                    </span>

                </div>
            </div>
        </div>
    </div>



    <x-male-female-stadistic title="contratos de Honorarios" male="{{ $t_honorarios['Male'] }}"
        female="{{ $t_honorarios['Female'] }}" total="{{ $t_honorarios['Total'] }}" />
 

 @include('home.card-birthday')


</div>



<div class="row shadow p-2 mb-4 bg-white rounded-bottom">


    <p class="text-start pb-2 mb-0 mt-2 fs-5 animate__animated animate__fadeIn animate__delay-1s">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 22 22">
            <path fill="#0284c7" d="M9 5H8v12h1v-1h1v-1h1v-1h1v-1h1v-1h1v-2h-1V9h-1V8h-1V7h-1V6H9" />
        </svg>
        <i>Próximos contratos por <b>vencer </b> o <b>expirados</b> </i>

    </p>

    <x-colorful-card :title="'C. Temporales'" :count="intval($statuses_contracts['T_Proximos'])" :subtitle="'Próximos a vencer'" :color="'card-proximos'" :link="route('worker.index', ['param' => 'Temporal'])">
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 16 16">
                <path fill="#ea580c" fill-rule="evenodd"
                    d="M8.175.002a8 8 0 1 0 2.309 15.603a.75.75 0 0 0-.466-1.426a6.5 6.5 0 1 1 3.996-8.646a.75.75 0 0 0 1.388-.569A8 8 0 0 0 8.175.002M8.75 3.75a.75.75 0 0 0-1.5 0v3.94L5.216 9.723a.75.75 0 1 0 1.06 1.06L8.53 8.53l.22-.22zM15 15a1 1 0 1 1-2 0a1 1 0 0 1 2 0m-.25-6.25a.75.75 0 0 0-1.5 0v3.5a.75.75 0 0 0 1.5 0z"
                    clip-rule="evenodd" />
            </svg>
        </x-slot>
    </x-colorful-card>


    <x-colorful-card :title="'C. de Temporales'" :count="intval($statuses_contracts['T_Expirados'])" :subtitle="'Expirados'" :color="'card-expirados'" :link="route('worker.index', ['param' => 'Expired-Temporal'])">
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 12 12">
                <path fill="#dc2626"
                    d="M1.757 10.243a6.001 6.001 0 1 1 8.488-8.486a6.001 6.001 0 0 1-8.488 8.486M6 4.763l-2-2L2.763 4l2 2l-2 2L4 9.237l2-2l2 2L9.237 8l-2-2l2-2L8 2.763Z" />
            </svg>
        </x-slot>
    </x-colorful-card>


    <x-colorful-card :title="'C. de Interinato'" :count="intval($statuses_contracts['I_Proximos'])" :subtitle="'Próximos a vencer'" :color="'card-proximos'" :link="route('worker.index', ['param' => 'Interinato'])">
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 16 16">
                <path fill="#ea580c" fill-rule="evenodd"
                    d="M8.175.002a8 8 0 1 0 2.309 15.603a.75.75 0 0 0-.466-1.426a6.5 6.5 0 1 1 3.996-8.646a.75.75 0 0 0 1.388-.569A8 8 0 0 0 8.175.002M8.75 3.75a.75.75 0 0 0-1.5 0v3.94L5.216 9.723a.75.75 0 1 0 1.06 1.06L8.53 8.53l.22-.22zM15 15a1 1 0 1 1-2 0a1 1 0 0 1 2 0m-.25-6.25a.75.75 0 0 0-1.5 0v3.5a.75.75 0 0 0 1.5 0z"
                    clip-rule="evenodd" />
            </svg>
        </x-slot>
    </x-colorful-card>



    <x-colorful-card :title="'C. de Interinato'" :count="intval($statuses_contracts['I_Expirados'])" :subtitle="'Expirados'" :color="'card-expirados'" :link="route('worker.index', ['param' => 'Expired-Interinato'])">
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 12 12">
                <path fill="#dc2626"
                    d="M1.757 10.243a6.001 6.001 0 1 1 8.488-8.486a6.001 6.001 0 0 1-8.488 8.486M6 4.763l-2-2L2.763 4l2 2l-2 2L4 9.237l2-2l2 2L9.237 8l-2-2l2-2L8 2.763Z" />
            </svg>
        </x-slot>
    </x-colorful-card>








    {{-- 
    <div class="col-6 col-md-3 col-xl-3 mb-3">
        <div class="card py-2 px-2 card-1">
            <div class="text-cont">
                <p class="mb-0 text-start fw-medium">
                    Próximos a vencer
                </p>
            </div>

            <div class="col-12 text-start mt-2 d-flex justify-content-between px-3">
                <span class="fs-2 fw-bold rounded-icon">{{ $Contratos['Temporales'] + $Contratos['Interinatos'] }}
                </span>
                <svg class="mt-2" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                    viewBox="0 0 16 16">
                    <path fill="#dc2626" fill-rule="evenodd"
                        d="M8.175.002a8 8 0 1 0 2.309 15.603a.75.75 0 0 0-.466-1.426a6.5 6.5 0 1 1 3.996-8.646a.75.75 0 0 0 1.388-.569A8 8 0 0 0 8.175.002M8.75 3.75a.75.75 0 0 0-1.5 0v3.94L5.216 9.723a.75.75 0 1 0 1.06 1.06L8.53 8.53l.22-.22zM15 15a1 1 0 1 1-2 0a1 1 0 0 1 2 0m-.25-6.25a.75.75 0 0 0-1.5 0v3.5a.75.75 0 0 0 1.5 0z"
                        clip-rule="evenodd" />
                </svg>
            </div>

            <div class="text-cont mt-0">
                <p class="fst-italic text-center">
                    <span class="fw-normal">Temporales e interinatos</span>
                </p>
            </div>
        </div>
    </div> --}}

    {{-- <div class="col-6 col-md-3 col-xl-3 mb-3">
        <div class="card py-2 px-2 card-2">
            <div class="text-cont">
                <p class="mb-0 text-start fw-medium">
                    Personal Activo
                </p>
            </div>

            <div class="col-12 text-start mt-2 d-flex justify-content-between px-3">
                <a href="{{ route('personal.index') }}"
                    class="fs-2 fw-bold rounded-icon">{{ $Workes_statuses['Activo']['Total'] }}
                </a>
                <svg class="mt-2" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                    viewBox="0 0 24 24">
                    <path fill="#059669"
                        d="M23 12c0 6.075-4.925 11-11 11S1 18.075 1 12S5.925 1 12 1s11 4.925 11 11M9.305 18.11l9.402-9.403l-1.414-1.414l-7.883 7.883l-2.476-3.01l-1.511 1.31l3.882 4.633z" />
                </svg>
            </div>

            <div class="text-cont mt-0">
                <p class="fst-italic text-center">
                    <span class="fw-normal">Hombres y mujeres</span>
                </p>
            </div>
        </div>
    </div> --}}


    {{-- <x-stats-card title="Temporales próximos a vencer" value="{{ $Contratos['Temporales'] }}" id="10"
        color="gb-card2" tooltip="Contratos Próximos a <b>Vencer</b>">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
            <path fill="#af4444"
                d="M2 12c0-2.79 1.64-5.2 4-6.32V3.5C2.5 4.76 0 8.09 0 12s2.5 7.24 6 8.5v-2.18C3.64 17.2 2 14.79 2 12m13-9c-4.96 0-9 4.04-9 9s4.04 9 9 9s9-4.04 9-9s-4.04-9-9-9m5 12.59L18.59 17L15 13.41L11.41 17L10 15.59L13.59 12L10 8.41L11.41 7L15 10.59L18.59 7L20 8.41L16.41 12z" />
        </svg>
    </x-stats-card>


    <x-stats-card title="Interinatos próximos a vencer" value="{{ $Contratos['Interinatos'] }}" id="10"
        color="gb-card6">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
            <path fill="#b66161"
                d="M2 12c0-2.79 1.64-5.2 4-6.32V3.5C2.5 4.76 0 8.09 0 12s2.5 7.24 6 8.5v-2.18C3.64 17.2 2 14.79 2 12m13-9c-4.96 0-9 4.04-9 9s4.04 9 9 9s9-4.04 9-9s-4.04-9-9-9m5 12.59L18.59 17L15 13.41L11.41 17L10 15.59L13.59 12L10 8.41L11.41 7L15 10.59L18.59 7L20 8.41L16.41 12z" />
        </svg>
    </x-stats-card> --}}




</div>
