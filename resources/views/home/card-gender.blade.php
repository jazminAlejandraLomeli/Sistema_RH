<div class="row">


    <p class="text-start pb-2 mb-0 mt-2 fs-5 animate__animated animate__fadeIn animate__delay-2s">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 22 22">
            <path fill="#0284c7" d="M9 5H8v12h1v-1h1v-1h1v-1h1v-1h1v-1h1v-2h-1V9h-1V8h-1V7h-1V6H9" />
        </svg>
        <i> Detalles de los <b>Nombramientos</b> </i>

    </p>



    {{-- Totales activos en tabla Administrativo --}}
    @foreach ($totales as $titulo => $valores)
        {{-- <div class="col-6 col-md-3 col-xl-2 mb-4"> --}}
            <x-male-female-stadistic :title="$titulo" :male="$valores['Male']" :female="$valores['Female']" :total="$valores['Total']"
                tooltip="" />
        {{-- </div> --}}
    @endforeach





    {{-- <p class="text-start pb-0 mb-0 mt-2"><i> Detalles de los <b>Nombramientos</b> en el centro universitario</i></p> --}}

    {{-- <x-stats-card title="Personal Total Activo" value="{{ 566 }}" id="10" color="gb-card1">
            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 24 24">
                <path fill="none" stroke="#0B5ED7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 21h18M9 8h1m-1 4h1m-1 4h1m4-8h1m-1 4h1m-1 4h1M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16" />
            </svg>
        </x-stats-card> --}}


    {{-- <x-male-female-stadistic title="Administrativo" male="{{ $totales['Administrativo']['Male'] }}"
        female="{{ $totales['Administrativo']['Female'] }}" total="{{ $totales['Administrativo']['Total'] }}"
        tooltip="" />

    <x-male-female-stadistic title="Directivo" male="{{ $totales['Directivo']['Male'] }}"
        female="{{ $totales['Directivo']['Female'] }}" total="{{ $totales['Directivo']['Total'] }}" tooltip="" />




    <x-male-female-stadistic title="Profesor de Asignatura" male="{{ $totales['Profesor de Asignatura']['Male'] }}"
        female="{{ $totales['Profesor de Asignatura']['Female'] }}"
        total="{{ $totales['Profesor de Asignatura']['Total'] }}" tooltip="" />


    <x-male-female-stadistic title="PTC´s" male="{{ $totales['Profesores de Tiempo Completo']['Male'] }}"
        female="{{ $totales['Profesores de Tiempo Completo']['Female'] }}"
        total="{{ $totales['Profesores de Tiempo Completo']['Total'] }}" tooltip="" />

    <x-male-female-stadistic title="Operativo" male="{{ $totales['Operativo']['Male'] }}"
        female="{{ $totales['Operativo']['Female'] }}" total="{{ $totales['Operativo']['Total'] }}" tooltip="" />


 --}}




</div>
