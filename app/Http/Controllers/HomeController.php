<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrativo;
use App\Models\Nombramiento;
use App\Models\Estado;
use App\Models\Personas_trabajo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $breadcrumbs = [
            ['name' => 'Inicio'],
        ];

        try {

            // Obtener todas las personas activas
            $Grupos = Personas_trabajo::with('administrativo.estado', 'nombramientoPersona')
                ->whereHas('administrativo.estado', fn($query) => $query->where('id_estado', 1))
                ->where("id_estado", 1)
                ->get();


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

            // return response()->json($CountContracts);

            // Obtener los contratos de Honorarios
            $Honorarios = Administrativo::with('honorario', 'estado')
                ->whereHas('honorario')
                ->where("estado_id", 1)
                ->get();
            // Agrupar por genero
            $t_honorarios = [
                'Total'  => $Honorarios->count(),
                'Female' => $Honorarios->where('sexo', 'Femenino')->count(),
                'Male'   => $Honorarios->where('sexo', 'Masculino')->count(),
            ];




            $today = Carbon::today();

            $expired = Personas_trabajo::with('administrativo')
                ->where('id_estado', 1)
                ->whereHas('administrativo', fn($query) => $query->where('estado_id', 1))
                ->where('fecha_termino', '<', $today)
                ->get();

            // 2. Contratos que vencen en los próximos 3 meses
            $aMonthsFromNow = Carbon::now()->addMonths(1);
            $expiringSoon = Personas_trabajo::with('administrativo')
                ->where('id_estado', 1)
                ->whereHas('administrativo', fn($query) => $query->where('estado_id', 1))
                ->whereBetween('fecha_termino', [$today, $aMonthsFromNow])
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
 
            return view('home', compact('totales', 'Workes_statuses', 'breadcrumbs', 't_honorarios', 'CountContracts', 'statuses_contracts'));
        } catch (\Exception $e) {
            Log::error('Error al obtener los datos del sistema' . $e->getMessage());
            return response()->json(['msg' => '¡Error! Hubo un error al al realizar la petición, inténtalo más tarde.', 'error' => $e->getMessage()], 404);
        }
    }
}
