<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\Update_Personal_DataRequest;
use App\Helpers\FormatHelper;
use App\Http\Requests\UpdatePersonalRequest;
use Illuminate\Http\Request;
use App\Models\Administrativo;
use App\Models\Estado;
use App\Services\LogsDataService;
use App\Services\PersonDataService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class PersonasController extends Controller
{
    /* 
        Funcion para mostrar en la tabla los registros de las personas en la tabla de la libreria de grid
    */

    public function index()
    {

        $breadcrumbs = [
            ['name' => 'Inicio', 'url' => route('home.index')],
            ['name' => 'Personal'],
        ];

        return view('workers.index', compact('breadcrumbs'));
    }
    public function getWorkers(Request $request)
    {
        try {
            $param = $request->input('param', '');
            $offset = $request->input('offset', 0);
            $limit = $request->input('limit', 10);
            $search = $request->input('search', '');

            // Costrir la query segun el param
            $query = $this->getQueryWithFilters($param);

            /* Busca por nombre, codigo, sexo o estado */
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('codigo', 'like', "%{$search}%")
                        ->orWhere('nombre', 'like', "%{$search}%")
                        // Buscar en la relación 'estado'
                        ->orWhereHas('estado', function ($subQuery) use ($search) {
                            $subQuery->where('nombre', 'like', "%{$search}%");
                        })
                        // Buscar en la relación anidada 'trabajos.nombramientoPersona'
                        ->orWhereHas('trabajos.nombramientoPersona', function ($subQuery) use ($search) {
                            $subQuery->where('nombre', 'like', "%{$search}%");
                        })
                    ;
                });
            }

            /* Contador de la consulta */
            $total_Personas = $query->count();
            $personas = $query->skip($offset)
                ->take($limit)
                ->orderBy('nombre', 'ASC')
                ->get()
                ->map(function ($persona) {
                    return [
                        'id' => $persona->id,
                        'id_estado' => $persona->estado_id,
                        'codigo' => $persona->codigo,
                        'nombre' => $persona->nombre,
                        'nombramiento' => $persona->trabajos[0]->nombramientoPersona->nombre ?? '--',
                        'estatus' => $persona->estado->nombre,
                    ];
                });
            return response()->json(['count' => $total_Personas, 'results' => $personas]);
        } catch (\Exception $e) {
            Log::error('Error al obtener los datos del trabajador ' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, al obtenero los registros de los trabajadores.', 'error' => $e->getMessage()], 500);
        }
    }

    /* 
        Funcion para hacer un Update a los datos personales  
    */
    public function edit($id)
    {

        try {

            $breadcrumbs = [
                ['name' => 'Inicio', 'url' => route('home.index')],
                ['name' => 'Personal', 'url' => route('worker.index')],
                ['name' => 'Detalles', 'url' => route('worker.detalles.mostrar', $id)],
                ['name' => 'Editar datos personales'],
            ];

            $worker = PersonDataService::getWorker($id);
            $estados = Estado::all();
            //   return response()->json($worker);
            return view('workers.details.update.personal', compact('breadcrumbs', 'worker', 'estados'));
        } catch (\Exception $e) {
            Log::error('Error al obtener los datos del trabajador ' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }


    /*
    Función para actualizar los datos personales de un trabajador 
*/
    public function update(UpdatePersonalRequest $request)
    {

        try {
            $data = $request['Personal'];
            $id =  $data['Id'];
            // Enviar datos para el Updated 
            PersonDataService::update($data, $id);
            // Logs
            if ($data['Status'] == 5) {
                LogsDataService::inactive_personal($data['Codigo'], $data['Nombre']);
            } else {

                LogsDataService::update_personal_data($data['Codigo'], $data['Nombre']);
            }


            return response()->json([
                'status' => 200,
                'msg' => '¡Éxito! Los datos del trabajador fueron actualizados.'
            ]);
        } catch (\Exception $e) {
            Log::error('Error al actualizar los datos del trabajador ' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }


    public function getWorkersDesigner(Request $request)
    {

        try {


            $offset = $request->input('offset', 0);
            $limit = $request->input('limit', 10);
            $search = $request->input('search', '');

            $query = Administrativo::with(['trabajos']);

            /* Busca por nombre, codigo, sexo o estado */
            if (!empty($search)) {
                $query->where('codigo', 'like', "%$search%")
                    ->orWhere('nombre', 'like', "%$search%")
                    ->orWhereHas('trabajos', function ($query) use ($search) {
                        $query->where('area_distincion', 'like', "%$search%");
                    });
            }

            /* Contador de la consulta */
            $total = $query->count();
            $people = $query->skip($offset)
                ->take($limit)
                ->select('id', 'codigo', 'nombre', 'foto_url')
                ->orderBy('nombre', 'ASC')
                ->get();

            return response()->json(['count' => $total, 'people' => $people]);
        } catch (\Exception $e) {
            Log::error('Error al obtener los datos del trabajador ' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }

    public function getWorkersDirectory(Request $request)
    {

        try {


            $offset = $request->input('offset', 0);
            $limit = $request->input('limit', 10);
            $search = $request->input('search', '');


            $rector = Administrativo::with(['trabajos'])
                ->where('codigo', '8913714');


            $administrativos = Administrativo::query()
                ->select('administrativos.*')
                ->whereNot('codigo', '8913714')
                // Subconsulta para obtener la mínima jerarquía (para ordenar administrativos)
                ->selectSub(function ($query) {
                    $query->select('jerarquias.jerarquia')
                        ->from('personas_trabajo')
                        ->join('jerarquias', 'jerarquias.area_distincion', '=', 'personas_trabajo.area_distincion')
                        ->whereColumn('personas_trabajo.id_persona', 'administrativos.id')
                        ->orderBy('jerarquias.jerarquia', 'asc')
                        ->limit(1);
                }, 'min_jerarquia')
                // Ordenar administrativos por su mínima jerarquía
                ->orderBy('min_jerarquia', 'asc')
                // Cargar TODOS los trabajos ordenados por jerarquía
                ->with(['trabajos' => function ($query) {
                    $query->join('jerarquias', 'jerarquias.area_distincion', '=', 'personas_trabajo.area_distincion')
                        ->orderBy('jerarquias.jerarquia', 'asc')  // Ordenar trabajos por jerarquía
                        ->select(
                            'personas_trabajo.*',
                            'jerarquias.jerarquia as nivel_jerarquia'
                        );
                }]);


            if (!empty($search)) {
                $administrativos->where(function ($query) use ($search) {
                    $query->where('administrativos.nombre', 'LIKE', "%$search%")
                        ->orWhereHas('trabajos', function ($subQuery) use ($search) {
                            $subQuery->where('area_distincion', 'LIKE', "%$search%");
                        });
                });

                $rector->where(function ($query) use ($search) {
                    return $query->where('nombre', 'like', "%$search%")
                        ->orWhereHas('trabajos', function ($subQuery) use ($search) {
                            $subQuery->where('area_distincion', "LIKE", "%$search%");
                        });
                });
            }



            $rector = $rector->first();

            $adjustedLimit = ($rector && $offset == 0) ? $limit - 1 : $limit;
            $total = $administrativos->count() + (($rector && $offset == 0) ? 1 : 0);

            $people = $administrativos->skip($offset)
                ->take($adjustedLimit)
                ->get();

            if ($rector && $offset == 0) {
                $people = $people->prepend($rector); // Ahora $people sigue teniendo $limit elementos exactos
            }


            $filter = $people->map(function ($person) {
                $trabajos = $person->trabajos;

                if ($trabajos->count() > 1) {
                    $verify = $trabajos->where('principal', 0)
                        ->where('id_estado', 1)->first();

                    if ($verify) {

                        $isTeacher = $verify->load('nombramientoPersona');

                        if (Str::contains($isTeacher->nombramientoPersona->nombre, 'Profesor de Asignatura', true)) {
                            $person->priority = $person->trabajos->first();
                        } else {
                            $person->priority = $verify;
                        }
                    } else {
                        $person->priority = $trabajos->first();
                    }
                } else {
                    $person->priority = $trabajos->first();
                }

                return $person;
            });

            return response()->json(['count' => $total, 'people' => $filter]);
        } catch (\Exception $e) {
            Log::error('Error al obtener los datos del trabajador ' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }


    /*
        Funcion para contruir la query segun los filtros enviados
    */
    private function getQueryWithFilters($param)
    {
        // Query general 
        $baseQuery = Administrativo::with([
            'estado',
            'trabajos' => fn($q) => $q->where('id_estado', 1),
            'trabajos.nombramientoPersona'
        ]);

        // Inicializa la query base
        $query = $baseQuery;

        //   Filtro por género
        if ($param === 'Femenino' || $param === 'Masculino') {
            $query = $baseQuery->where('sexo', $param);
        }

        //  Filtro por contratos "Temporal" o "Interinato"
        else if ($param === 'Temporal' || $param === 'Interinato') {

            $aMonthFromNow = Carbon::now()->addMonths(1);

            $query = $baseQuery->where(function ($q) use ($param, $aMonthFromNow) {
                $q->whereHas('trabajos', function ($subQuery) use ($param, $aMonthFromNow) {
                    $subQuery->where('tipo_contrato', $param)
                        ->whereBetween('fecha_termino', [Carbon::now(), $aMonthFromNow]);
                })
                    // 👇 Esto permite incluir también los administrativos sin trabajos
                    ->orDoesntHave('trabajos');
            });
        }

        //  Filtro por Interinatos expirados
        else if ($param === 'Expired-Interinato') {
            $query = $baseQuery->where(function ($q) {
                $q->whereHas('trabajos', function ($subQuery) {
                    $subQuery->where('tipo_contrato', 'Interinato')
                        ->where('fecha_termino', '<', Carbon::today());
                })
                    ->orDoesntHave('trabajos');
            });
        }

        // Filtro por Temporales expirados
        else if ($param === 'Expired-Temporal') {
            $query = $baseQuery->where(function ($q) {
                $q->whereHas('trabajos', function ($subQuery) {
                    $subQuery->where('tipo_contrato', 'Temporal')
                        ->where('fecha_termino', '<', Carbon::today());
                })
                    ->orDoesntHave('trabajos');
            });
        }

        // Si no coincide con ningún filtro específico
        else {
            $query = $baseQuery;
        }

        return $query;
    }
}
