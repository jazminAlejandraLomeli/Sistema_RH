<?php

namespace App\Services;

use App\Helpers\FormatHelper;
use App\Models\Administrativo;
use App\Models\Domicilio;
use App\Models\Estado;
use App\Models\Personas_trabajo;

class HomeService
{

    public static function Data()
    {
        // Obtener todas las personas activas
        $Grupos = Personas_trabajo::with('administrativo.estado', 'nombramientoPersona')->whereHas('administrativo.estado', fn($query) => $query->where('id_estado', 1))->where("id_estado", 1)->get();

        return $Grupos;
    }

    public static function Totals($Grupos)
    {
        // Trabajadores totales por genero, nombramiento y ACTIVOS
        $totales = $Grupos->groupBy(function ($trabajo) {
            return $trabajo->nombramientoPersona->nombre;  // Agrupar por nombramiento
        })->map(function ($grupoDeTrabajos) {
            $generos = $grupoDeTrabajos->groupBy(function ($trabajo) {
                return $trabajo->administrativo->sexo;
            })->map->count();
            return [
                'Total' => $grupoDeTrabajos->count(),
                'Female' => $generos->get('Femenino', 0),
                'Male' => $generos->get('Masculino', 0),
            ];
        });

        return $totales;
    }

    public static function Contratos($Grupos)
    {
        // Obtener los contratos por genero
        $CountContracts = $Grupos->groupBy(function ($trabajo) {
            return $trabajo->tipo_contrato;  // Agrupar por contrato
        })->map(function ($gruposContratos) {
            $generos = $gruposContratos->groupBy(function ($trabajo) {
                return $trabajo->administrativo->sexo;
            })->map->count();
            return [
                'Total' => $gruposContratos->count(),
                'Female' => $generos->get('Femenino', 0),
                'Male' => $generos->get('Masculino', 0),
            ];
        });
        return $CountContracts;
    }
    public static function GetHonorarios()
    {
        // Obtener los contratos de Honorarios
        $Honorarios = Administrativo::with('honorario', 'estado')->whereHas('honorario')->where("estado_id", 1)->get();
        $t_honorarios = [
            'Total'  => $Honorarios->count(),
            'Female' => $Honorarios->where('sexo', 'Femenino')->count(),
            'Male'   => $Honorarios->where('sexo', 'Masculino')->count(),
        ];
        return $t_honorarios;
    }


    public static function GetContracts($today, $month)
    {
        $expired = Personas_trabajo::with('administrativo')
            ->where('id_estado', 1)
            ->whereHas('administrativo', fn($query) => $query->where('estado_id', 1))
            ->where('fecha_termino', '<', $today)
            ->get();

        $expiringSoon = Personas_trabajo::with('administrativo')
            ->where('id_estado', 1)
            ->whereHas('administrativo', fn($query) => $query->where('estado_id', 1))
            ->whereBetween('fecha_termino', [$today, $month])
            ->get();

        // Agrupaciones y conteo
        $expiringSoonCount = $expiringSoon->groupBy('tipo_contrato')->map->count();
        $expiredCount = $expired->groupBy('tipo_contrato')->map->count();

        // Estructura final con los resultados
        $statuses_contracts = [
            'T_Proximos' => $expiringSoonCount->get('Temporal', 0),
            'I_Proximos' => $expiringSoonCount->get('Interinato', 0),
            'T_Expirados' => $expiredCount->get('Temporal', 0),
            'I_Expirados' => $expiredCount->get('Interinato', 0),
        ];


        return $statuses_contracts;
    }
    public static function ContractsExpired($today, $month)
    {
        $expiringSoon = Personas_trabajo::with('administrativo')
            ->where('id_esGrupostado', 1)
            ->whereHas('administrativo', fn($query) => $query->where('estado_id', 1))
            ->whereBetween('fecha_termino', [$today, $month])
            ->get();
        return $expiringSoon;
    }
    public static function ContractsExpiredDetails($expiringSoonCount, $expiredCount)
    {
        $statuses_contracts = [
            'T_Proximos' => $expiringSoonCount->get('Temporal', 0),
            'I_Proximos' => $expiringSoonCount->get('Interinato', 0),
            'T_Expirados' => $expiredCount->get('Temporal', 0),
            'I_Expirados' => $expiredCount->get('Interinato', 0),
        ];

        return $statuses_contracts;
    }

    public static function GetWorkers()
    {
        $allStates = Estado::pluck('nombre');
        $Workes = Administrativo::with('estado')->get(); // Jalar todos los datos

        // Agrupar por nombre del estado y contar por género
        $grouped = $Workes->groupBy(fn($person) => $person->estado?->nombre ?? 'Sin Estado')
            ->map(function ($group) {
                return [
                    'Total'  => $group->count(),
                    'Female' => $group->where('sexo', 'Femenino')->count(),
                    'Male'   => $group->where('sexo', 'Masculino')->count(),
                ];
            });

        //  Completar con estados vacíos si faltan
        $Workes_statuses = collect();

        foreach ($allStates as $stateName) {
            $Workes_statuses->put($stateName, $grouped->get($stateName, [
                'Total' => 0,
                'Female' => 0,
                'Male' => 0
            ]));
        }

        return $Workes_statuses;
    }

    public static function GetHBD($month)
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
            'month_number' => $month,    // 11
        ];
    }
}
