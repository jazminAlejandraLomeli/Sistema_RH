<div class="row  shadow p-4 mb-4 bg-white rounded-bottom">


    <p class="text-start pb-2 mb-0 mt-2 fs-5 animate__animated animate__fadeIn ">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 22 22">
            <path fill="#0284c7" d="M9 5H8v12h1v-1h1v-1h1v-1h1v-1h1v-1h1v-2h-1V9h-1V8h-1V7h-1V6H9" />
        </svg>
        <i> Detalles del <b>personal</b> </i>

    </p>
    <x-colorful-card :title="'Personal'" :count="intval($Workes_statuses['Activo']['Total'])" :subtitle="' Personal activo '" :color="'card-1'" :link="route('personal.index')">
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                <path fill="#059669"
                    d="M12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12q0-.8.125-1.6T2.5 8.825q.125-.4.513-.537t.737.062q.375.2.538.588t.037.812q-.15.55-.238 1.113T4 12q0 3.35 2.325 5.675T12 20t5.675-2.325T20 12t-2.325-5.675T12 4q-.6 0-1.187.087T9.65 4.35q-.425.125-.8-.025T8.3 3.8t-.013-.762t.563-.513q.75-.275 1.55-.4T12 2q2.075 0 3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22M5.5 7q-.625 0-1.062-.437T4 5.5t.438-1.062T5.5 4t1.063.438T7 5.5t-.437 1.063T5.5 7m6.5 5" />
            </svg> </x-slot>
    </x-colorful-card>

    <x-colorful-card :title="'Femenino'" :count="intval($Workes_statuses['Activo']['Female'])" :subtitle="'Activo femenino '" :color="'card-female'" :link="route('personal.index', ['param' => 'Femenino'])">
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                <g fill="none" fill-rule="evenodd">
                    <path
                        d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                    <path fill="#db2777"
                        d="M7 9.5a7.5 7.5 0 1 1 2.942 5.957l-1.788 1.787L9.58 18.67a1 1 0 1 1-1.414 1.414L6.74 18.659l-2.12 2.12a1 1 0 0 1-1.414-1.415l2.12-2.12l-1.403-1.403a1 1 0 1 1 1.414-1.414L6.74 15.83l1.79-1.79A7.47 7.47 0 0 1 7 9.5M14.5 4a5.5 5.5 0 1 0 0 11a5.5 5.5 0 0 0 0-11" />
                </g>
            </svg> </x-slot>
    </x-colorful-card>

    <x-colorful-card :title="'Masculino'" :count="intval($Workes_statuses['Activo']['Male'])" :subtitle="'Activo masculino '" :color="'card-male'" :link="route('personal.index', ['param' => 'Masculino'])">
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48">
                <g fill="none" stroke="#0284c7" stroke-linejoin="round" stroke-width="4">
                    <path stroke-linecap="round" d="M41.952 15.048v-9h-9" />
                    <path
                        d="M10.414 38c5.467 5.468 14.331 5.468 19.799 0a13.96 13.96 0 0 0 4.1-9.899a13.96 13.96 0 0 0-4.1-9.9c-5.468-5.467-14.332-5.467-19.8 0c-5.467 5.468-5.467 14.332 0 19.8Z" />
                    <path stroke-linecap="round" d="m30 18l9.952-9.952" />
                </g>
            </svg>
        </x-slot>
    </x-colorful-card>

    <x-colorful-card :title="'Honorarios'" :count="intval( $t_honorarios['Total'])" :subtitle="'Total Honorarios '" :color="'card-4'" :link="route('honorario.index')">
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#35a715" d="M9.385 8.385v-1h8.23v1zm0 2.769v-1h8.23v1zM11.846 20H5zm0 1H6q-.846 0-1.423-.577T4 19v-2.77h3V3h13v7.89q-.27.008-.513.057q-.243.05-.487.14V4H8v12.23h5.346l-1 1H5V19q0 .425.288.713T6 20h5.846zm2.385 0v-2.21l5.333-5.307q.148-.148.307-.2q.16-.052.32-.052q.165 0 .334.064q.17.065.298.194l.925.944q.123.148.187.308q.065.159.065.319t-.061.322t-.191.31L16.44 21zm6.885-5.94l-.925-.945zm-6 5.056h.95l3.467-3.474l-.47-.475l-.455-.488l-3.492 3.486zm3.948-3.949l-.456-.488l.925.963z"/></svg>
        </x-slot>
    </x-colorful-card>

     

    {{-- <x-male-female-stadistic title="Personal Activo" male="{{ $Workes_statuses['Activo']['Male'] }}"
         female="{{ $Workes_statuses['Activo']['Female'] }}" total="{{ $Workes_statuses['Activo']['Total'] }}"
         tooltip="Desglose de genero del personal <b>Activo</b>" /> --}}

    {{-- 
     <x-male-female-stadistic title="De licencia" male="{{ $Workes_statuses['De licencia']['Male'] }}"
         female="{{ $Workes_statuses['De licencia']['Female'] }}" total="{{ $Workes_statuses['De licencia']['Total'] }}"
         tooltip="Desglose de genero del personal de <b>De Licencia</b>" />


     <x-male-female-stadistic title="Incapacidad" male="{{ $Workes_statuses['Incapacidad']['Male'] }}"
         female="{{ $Workes_statuses['Incapacidad']['Female'] }}" total="{{ $Workes_statuses['Incapacidad']['Total'] }}"
         tooltip="Desglose de genero del personal de <b>Incapacidad</b>" />


     <x-male-female-stadistic title="Inactivo" male="{{ $Workes_statuses['Inactivo']['Male'] }}"
         female="{{ $Workes_statuses['Inactivo']['Female'] }}" total="{{ $Workes_statuses['Inactivo']['Total'] }}"
         tooltip="Desglose de genero del personal <b>Inactivo</b>" />

     <x-male-female-stadistic title="Traslado" male="{{ $Workes_statuses['Traslado']['Male'] }}"
         female="{{ $Workes_statuses['Traslado']['Female'] }}" total="{{ $Workes_statuses['Traslado']['Total'] }}"
         tooltip="Desglose de genero del personal en <b>Traslado</b>" /> --}}



</div>
