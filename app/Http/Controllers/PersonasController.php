<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\Update_Personal_DataRequest;
use App\Helpers\FormatHelper;
use Illuminate\Http\Request;
use App\Models\Administrativo;
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
                    $q->where('codigo', 'like', "%$search%")
                        ->orWhere('nombre', 'like', "%$search%")
                        // Buscar por nombre en la tabla "estados" (activo, inactivo, etc.)
                        ->orWhereHas('estado', function ($subQuery) use ($search) {
                            $subQuery->where('nombre', 'like', "%$search%");
                        })
                        ->orWhereHas('trabajos.nombramientoPersona', function ($subQuery) use ($search) {
                            $subQuery->where('nombre', 'like', "%$search%");
                        });
                });
            }

            /* Contador de la consulta */
            $total_Personas = $query->count();
            $personas = $query->skip($offset)
                ->take($limit)
                ->get()
                ->map(function ($persona) {
                    return [
                        'id' => $persona->id,
                        'id_estado' => $persona->estado_id,
                        'codigo' => $persona->codigo,
                        'nombre' => $persona->nombre,
                        'nombramiento' => $persona->trabajos[0]->nombramientoPersona->nombre,
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
    public function updatePerson(Update_Personal_DataRequest $request, $id_persona)
    {


        $validatedData = $request->validated();

        $Codigo = $request['Codigo'];
        $Nombre = $request['nombre'];
        $F_NacimienTo = $request['f_nacimiento'];
        $F_Ingreso = $request['f_ingreso'];
        $Correo = $request['correo'];
        $name_emer = $request['name_emergencia'];
        $Telefono = $request['tel_emergencia'];
        $parentesco = $request['parentesco_emergencia'];
        /*
            Mapear los datos 
        */

        $Estado = $request['estado_id'];

        $Genero = FormatHelper::getSexo($request['genero']);
        $Grado = FormatHelper::getGrado($request['estudios']);

        try {

            DB::beginTransaction();
            $administrativo = Administrativo::findOrFail($id_persona);

            $administrativo->update([
                'nombre' => $Nombre,
                'correo' => $Correo,
                'codigo' => $Codigo,
                'fecha_nacimiento' => $F_NacimienTo,
                'estado_id' => $Estado,
                'sexo' => $Genero,
                'tel_emergencia' => $Telefono,
                'nombre_emergencia' => $name_emer,
                'ultimo_grado' => $Grado,
                'fecha_ingreso' => $F_Ingreso,
                'e_parentesco' => $parentesco,
            ]);

            DB::commit();

            return response()->json(['status' => 200, 'msg' => '¡Exito! Registro fue editado correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
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

        $baseQuery = Administrativo::with('estado', 'trabajos', 'trabajos.nombramientoPersona')
            ->whereHas('trabajos', fn($query) => $query->where('id_estado', 1));

        $query = $baseQuery;

        if ($param == 'Femenino' || $param == 'Masculino') {    /// Genero
            $query = $baseQuery->where('sexo', $param);
        } else if ($param === 'Temporal' || $param === 'Interinato') {  // Tipo de contrato proximo a expirar

            $query = $baseQuery->whereHas('trabajos', function ($subQuery) use ($param) {
                $subQuery->where('tipo_contrato', $param);
            });

            $aMonthsFromNow = Carbon::now()->addMonths(1);
            $query = $query->whereHas('trabajos', function ($subQuery) use ($aMonthsFromNow) {
                $subQuery->whereBetween('fecha_termino', [Carbon::now(), $aMonthsFromNow]);
            });
        } else if ($param === 'Expired-Interinato') {   // Proximos Interinatos Expirados

            $query = $baseQuery->whereHas('trabajos', function ($subQuery) {
                $subQuery->where('tipo_contrato', 'Interinato')
                    ->where('fecha_termino', '<', Carbon::today());
            });
        } else if ($param === 'Expired-Temporal') {  // Proximos Temporales Expirados
            $query = $baseQuery->whereHas('trabajos', function ($subQuery) {
                $subQuery->where('tipo_contrato', 'Temporal')
                    ->where('fecha_termino', '<', Carbon::today());
            });
        }

        return $query;
    }
}
