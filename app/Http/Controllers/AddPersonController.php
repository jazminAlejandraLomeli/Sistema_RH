<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\Insert_WorkerRequest;
use App\Helpers\FormatHelper;

use App\Models\Categoria;
use App\Models\Nombramiento;
use App\Models\Administrativo;
use App\Models\Departamento;
use App\Models\persona_has_adicional;
use App\Models\Personas_trabajo;
use Illuminate\Support\Facades\Log;


class AddPersonController extends Controller
{

    /*
        Funcion para mostrar la vista de Agregra personal y mandar los datos del breadcrumb
    */
    public function index()
    {


        $breadcrumbs = [
            ['name' => 'Inicio', 'url' => route('home.index')],
            ['name' => 'personal', 'url' => route('personal.index')],
            ['name' => 'Agregar personal', '' => ''],
        ];

        $nombramientos = Nombramiento::all();
        $departamentos = Departamento::all();
        return view('workers.new-worker.new-worker', compact('nombramientos', 'departamentos', 'breadcrumbs'));
    }

    /* Validar que el código agregado no se repita */
    public function Search_Code(Request $request)
    {
        try {
            $data = $request->validate([
                'Codigo' => 'required|numeric|digits:7',

            ]);

            $Codigo = $data['Codigo'];
            $Persona = Administrativo::where('codigo', $Codigo)->first();

            if ($Persona) {
                return response()->json(['status' => false, 'msg' => 'El código ya esta enlazado a otra persona.']);
            } else {
                return response()->json(['status' => true, 'msg' => 'El código esta disponible.']);
            }
        } catch (\Exception $e) {
            Log::error('Error al buscar el código' . $e->getMessage());
            return response()->json(['status' => 404, 'msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()]);
        }
    }

    /*
    Extraer las categorias segun el nombramiento y el genero...
        y extraer la distincion adicional en caso de que haya alguna
*/
    public function search_distincion(Request $request)
    {
        try {
            $id =  $request['Id'];
            $dist =  $request['Dist'];
            $genero =  $request['Genero'];

            // Genero --> 1 masculino  2  femenino  3 ambos
            $categorias = [];
            $distinciones = [];
            $SQL_cate = Categoria::where('id_nombramiento', $id)
                ->where(function ($query) use ($genero) {
                    $query->where('genero', $genero)
                        ->orWhere('genero', 3);
                })
                ->get();

            foreach ($SQL_cate as $categoria) {
                $categorias[] = [
                    'id' =>  $categoria->id,
                    'nombre' => $categoria->nombre,
                ];
            }

            if ($dist == 1) {
                $distinciones = persona_has_adicional::with('distincionAdicional')
                    ->where('id_nombramiento', $id)
                    ->get();
            }
            return response()->json(['status' => 200, 'Categorias' => $categorias, 'Adicional' => $distinciones]);
        } catch (\Exception $e) {
            Log::error('Error al buscar la distinción' . $e->getMessage());
            return response()->json(['status' => 404, 'msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()]);
        }
    }


    /* 
        Guardar un nuevo registro a la base de datos, hasta este punto ya se sabe si el codigo que se ingreso esta disponible
     */
    public function guardarPersonal(Insert_WorkerRequest $request)
    {

        $data = $request->validated();

        // Valores a mapear
        $Genero = FormatHelper::getSexo($data['Personal']['Genero']);
        $Grado = FormatHelper::getGrado($data['Personal']['estudios']);
        $Turno = FormatHelper::getTurno($data['Job']['Turno']);
        $Contrato = FormatHelper::getContrato($data['Job']['Contrato']);
        $Horas = FormatHelper::getHoras($data['Job']['Horas']);

        try {
            DB::beginTransaction();

            // Tabla de calnedario 
            $persona = Administrativo::create([
                'codigo' => $data['Personal']['Codigo'],
                'nombre' => $data['Personal']['nombre'],
                'correo' => $data['Personal']['correo'],
                'fecha_nacimiento' => $data['Personal']['f_nacimiento'],
                'sexo' =>  $Genero,
                'estado_id' => 1,
                'fecha_ingreso' => $data['Personal']['f_ingreso'],
                'ultimo_grado' => $Grado,
                'nombre_emergencia' => $data['Personal']['nombre_e'],
                'e_parentesco' => $data['Personal']['parentesco'],
                'tel_emergencia' => $data['Personal']['telefono'],
           
                'created_by' => auth()->user()->id,
            ]);


            $id_persona = $persona->id;

            $Trabajo = Personas_trabajo::create([
                'id_persona' => $id_persona,
                'nombramiento' => $data['Job']['Nombramiento'],
                'id_categoria' => $data['Job']['Categoria'],
                'principal' => 1,
                'horas_trabajo' => $Horas,
                'turno' => $Turno,
                'horario_oficial' => $data['Job']['Oficial'],
                'tipo_contrato' => $Contrato,
                'fecha_termino' => $data['Job']['Vencimiento'],
                'distincion_ad' => $data['Job']['Adicional'],
                'area_distincion' => $data['Job']['Adscripcion'],
                'id_estado' => 1,  // Activo
                'semblanza' => $data['Job']['Semblanza'],

            ]);

            $isSubjectTeacher = Nombramiento::where('nombre', 'LIKE', '%Profesor de Asignatura%')->first();

            if ($isSubjectTeacher->id == $data['Job']['Nombramiento']) {
                $departamentos = $data['Job']['Departamentos'];
                $Trabajo->departamento()->attach($departamentos);
            }

            DB::commit();
            return response()->json(['status' => 200, 'msg' => '¡Éxito! La persona fue agregada al sistema.']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al agregar a la persona al sistema' . $e->getMessage());
            return response()->json(['status' => 404, 'msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()]);
        }
    }
}
