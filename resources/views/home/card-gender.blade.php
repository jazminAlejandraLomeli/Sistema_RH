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
                tooltip="Desglose de los contadores por género" />
        {{-- </div> --}}
    @endforeach


</div>
