<?php

namespace App\Services;

use App\Models\Administrativo;

class   BirthdaysService
{

    public static function getHBD($month)
    {
        //
        $hbd = Administrativo::where('estado_id', 1)
            ->whereMonth('fecha_nacimiento', $month) // filtrar solo por mes
            ->orderByRaw('DAY(fecha_nacimiento) ASC') // ordenar por día del mes
            ->get()
            ->map(function ($persona) {

                // Extraer día y mes del cumpleaños
                $dia = \Carbon\Carbon::parse($persona->fecha_nacimiento)->day;
                $mes = \Carbon\Carbon::parse($persona->fecha_nacimiento)->month;
                $anioActual = now()->year;

                // Crear fecha con mismo día y mes pero año actual
                $cumpleEsteAnio = \Carbon\Carbon::create($anioActual, $mes, $dia);

                // Día de la semana + número del día
                $diaCompleto = $cumpleEsteAnio->locale('es')->isoFormat('dddd D');

                return [
                    'nombre' => $persona->nombre,
                    'dia' => $diaCompleto, // ej: "sábado 2"
                ];
            });


        $mes = now()->translatedFormat('F');
        $count = $hbd->count();

        return [
            'name_month' =>  $mes,
            'count' =>  $count,
            'people' =>  $hbd,
            'month_number' => $month,
        ];
    }

    /*
    Funcion para extraer los cumpleañeros del dia 
    */
    public static function getTodayHBD($today)
    {
        $hbd = Administrativo::where('estado_id', 1)
            ->whereDay('fecha_nacimiento', $today->day) // Dia 
            ->whereMonth('fecha_nacimiento', $today->month) // mes
            ->orderBy('nombre', 'asc')
            ->get()
            ->map(function ($persona) {  // enviar solo datos necesarios 
                return [
                    'nombre' => $persona->nombre,
                    'id' => $persona->id,
                    'code' => $persona->codigo

                ];
            });

        $day = $today->translatedFormat('l j \d\e F');
        $count = $hbd->count();
        $isSent = HbdSentService::getdata($today);


        return [
            'count' => $count,
            'people' => $hbd,
            'day' => $day,
            'sent' =>  $isSent
        ];
    }
}
