<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Administrativo;
use App\Models\Estado;
use App\Http\Requests\Insert_jobRequest;
use App\Models\Categoria;
use App\Helpers\FormatHelper;
use App\Models\Departamento;
use App\Models\Nombramiento;
use App\Models\Distincion_Adicional;
use App\Models\Personas_trabajo;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
/*
    Controlador  para las consultas u operaciones que tienen que ver con un trabajador y su nombramiento
*/

class Personas_TrabajoController extends Controller
{

    /* 
        Funcion para agregarle un nombramirnto a una persona desde la vista de detalles 
        por ello aqui ya no se mandan los datos personales
    */
    public function guardarNombramiento(Insert_jobRequest $request)
    {

        $data = $request->validated();
        // Valores a mapear
        $Turno = FormatHelper::getTurno($data['Job']['Turno']);
        $Contrato = FormatHelper::getContrato($data['Job']['Contrato']);
        $Horas = FormatHelper::getHoras($data['Job']['Horas']);

        try {
            DB::beginTransaction();

            $Trabajo = Personas_trabajo::create([
                'id_persona' =>  $data['Job']['Id'],
                'nombramiento' => $data['Job']['Nombramiento'],
                'id_categoria' => $data['Job']['Categoria'],
                'principal' => $data['Job']['Principal'],
                'horas_trabajo' => $Horas,
                'turno' => $Turno,
                'horario_oficial' => $data['Job']['Oficial'],
                'tipo_contrato' => $Contrato,
                'fecha_termino' => $data['Job']['Vencimiento'] ?? null,
                'distincion_ad' => $data['Job']['Adicional'],
                'area_distincion' => $data['Job']['Adscripcion'],
                'id_estado' => 1,  // Activo
                'semblanza' => $data['Job']['Semblanza'],

                'created_by' => auth()->user()->id,
            ]);

            $isSubjectTeacher = Nombramiento::where('nombre', 'LIKE', '%Profesor de Asignatura%')->first();

            if ($isSubjectTeacher->id == $data['Job']['Nombramiento']) {
                $departamentos = $data['Job']['Departamentos'];
                $Trabajo->departamento()->attach($departamentos);
            }

            DB::commit();
            return response()->json(['status' => 200, 'msg' => '¡Éxito! El nombramiento fue agregado al sistema.']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al agregar el nombramiento' . $e->getMessage());

            return response()->json(['status' => 404, 'msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()]);
        }
    }

    /* 
        Funcion que busca el código de la persona y si esta te redirige a la vista de detalles
    */
    public function mostrarDetalles($id)
    {
        try {
            $Busca = Administrativo::find($id);
            if (!$Busca) {
                return redirect('/personal');
            }
            $Genero = $Busca->sexo;

            if ($Genero == "Masculino") {
                $Genero = 1;
            } else {
                $Genero = 2;
            }
            $Persona = Personas_trabajo::where('id_persona', $id)->get();

            $Cate1 = "";
            $Cate2 = "";
            // Contar los nombramientos
            if ($Persona->count() == 2) {
                // Extraemos el ID Nombramiento de cada puesto
                foreach ($Persona as $registro) {
                    if ($registro->principal == 1) {
                        $Cate1 = $registro->nombramiento;
                    } else {
                        $Cate2 = $registro->nombramiento;
                    }
                }
            } else if ($Persona->count() == 1) {
                $Cate1 = $Persona->first()->nombramiento;
            } else {
                $Cate1 = "";
            }

            // Mandamos datos para mostrarlos en los modales
            $estados = Estado::all();
            $nombramientos = Nombramiento::all();
            $distinciones = Distincion_Adicional::all();
            $departamentos = Departamento::all();
            /* Categorias ya procezadas */
            $Categorias1 = Categoria::where('id_nombramiento', $Cate1)
                ->where(function ($query) use ($Genero) {
                    $query->where('genero', $Genero)
                        ->orWhere('genero', 3);
                })
                ->get();

            $Categorias2 = Categoria::where('id_nombramiento', $Cate2)
                ->where(function ($query) use ($Genero) {
                    $query->where('genero', $Genero)
                        ->orWhere('genero', 3);
                })
                ->get();

            /* Verificar que si existe la persona */
            $persona = Administrativo::with(['estado'])->where('id', $id)->first();
            $Principal = Personas_trabajo::with(['nombramientoPersona', 'trabajoCategoria', 'estado', 'distincionAdicional', 'departamento'])->where('id_persona', $id)->where('principal', 1)->first() ?? $Principal = [];
            $Trabajo = Personas_trabajo::with(['nombramientoPersona', 'trabajoCategoria', 'estado', 'distincionAdicional', 'departamento'])->where('id_persona', $id)->where('principal', 0)->first() ?? $Trabajo = [];

            $F_nacimiento = $persona->fecha_nacimiento;
            $fechaActual = now();
            $edad = $fechaActual->diff($F_nacimiento)->y;
            $F_ingreso = $persona->fecha_ingreso;
            $fechaActual = now();
            $anti = $fechaActual->diff($F_ingreso)->y;
            // Breadcrumb 
            $breadcrumbs = [
                ['name' => 'Inicio', 'url' => route('home.index')],
                ['name' => 'Personal', 'url' => route('personal.index')],
                ['name' => 'Detalles'],
            ];

            //  return response()->json($Principal);
            /* Mandar los datos a la vista */
            return view(
                'workers.DetallesPersona',
                [
                    'id' => $id,
                    'estados' => $estados,
                    'nombramientos' => $nombramientos,
                    'categorias1' => $Categorias1,
                    'categorias2' => $Categorias2,
                    'distinciones' => $distinciones,
                    'edad' =>  $edad,
                    'Principal' =>  $Principal,
                    'Trabajo' =>  $Trabajo,
                    'Antiguedad' =>  $anti,
                    'persona' =>  $persona,
                    'departamentos' => $departamentos
                ],
                compact('breadcrumbs')
            );
        } catch (Exception $e) {
            Log::error('Error al obtener los datos del trabajador ' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }

    /* 
        Funcion para Eliminar un nombramiento, 
            Si es el secundario solo se borra si es el principal y hay un secundario 
                El secundario pasa a ser el principal 
    */
    public function eliminarNomb(Request $request)
    {
        $data = $request->validate([
            'Id_trabajo' => 'required|numeric',
            'Id_Persona' => 'required|numeric',
        ]);


        $persona = $data['Id_Persona'];
        $trabajo = $data['Id_trabajo'];

        try {
            
            DB::transaction(
                function () use ($persona, $trabajo) {

                    // Buscar registro
                    $Trabajos = Personas_trabajo::where('id_persona', $persona)->count();

                    if ($Trabajos == 2) {  /// tiene dos nombramientos 

                        $Trabajo = Personas_trabajo::where('id_persona', $persona)->where('id', $trabajo)->first();

                        if ($Trabajo->principal == 1) { // Nombramiento principal se borra y el secundario pasa a ser el principal 

                            if ($Trabajo->nombramiento == 6) { ///  si es Profesor de asignatura se borra la tabla pivote
                                $Trabajo->departamento()->detach();
                            }

                            $Trabajo->delete();  // Borrar registro

                            // Secundario pasa a ser el principal  
                            $change_principal = Personas_trabajo::where('id_persona', $persona)->first();
                            $change_principal->principal = 1;
                            $change_principal->save();
                        } else { // Secundario solo se borra 

                            if ($Trabajo->nombramiento == 6) { ///  si es Profesor de asignatura se borra la tabla pivote
                                $Trabajo->departamento()->detach();
                            }


                            $Trabajo->delete();  // Borrar registro
                        }
                    } else { /// solo tiene ese nombramiento 
                        $Trabajo = Personas_trabajo::where('id_persona', $persona)->where('id', $trabajo)->first();

                        if ($Trabajo->nombramiento == 6) { ///  si es Profesor de asignatura se borra la tabla pivote
                            $Trabajo->departamento()->detach();
                        }
                        $Trabajo->delete();  // Borrar registro
                    }
                }
            );

            DB::commit();

            return response()->json(['status' => 200, 'msg' => '¡Exito! El nombramiento fue borrado correctamente.']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar el nombramiento de la persona' . $e->getMessage());
            return response()->json(['status' => 404, 'msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()]);
        }
    }

    /*
      Funcion para cambiar el nombramiento secundario a ser el principal y el principal sera el secundario
    */
    public function cambiarNombramiento(Request $request)
    {

        $data = $request->validate([
            'Id_persona' => 'required|numeric|exists:administrativos,id',
         ]);

        $Id = $data['Id_persona'];

        try {
            DB::transaction(function () use ($Id) {

                $personasTrabajo = Personas_trabajo::where('id_persona', $Id)->get();

                if ($personasTrabajo->isEmpty()) {
                    throw new Exception('¡Error! No se encontraron registros.');
                } elseif ($personasTrabajo->count() != 2) {
                    throw new Exception('¡Error! Deben haber exactamente dos registros.');
                }

                foreach ($personasTrabajo as $personaTrabajo) {
                    $personaTrabajo->principal = ($personaTrabajo->principal == 1) ? 0 : 1;
                    $personaTrabajo->updated_by = auth()->user()->id;
                    $personaTrabajo->save();
                }
            });
            DB::commit();
            return response()->json(['status' => 200, 'message' => 'Nombramientos cambiados correctamente']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al cambiar los nombramientos de la persona' . $e->getMessage());
            return response()->json(['status' => 404, 'msg' => '¡Error! ' . $e->getMessage()]);
        }
    }

    /* 
        Funcion para editar datos del nombramiento, puede ser del principal o del secundario 
            segun lo defina la variable de Data.Principal 
                1 --> Principal    0 --> secunadario
     */
    public function editarNomb(Insert_jobRequest $request, $Id)
    {

        $data = $request->validated();
        // Valores a mapear
        $Turno = FormatHelper::getTurno($data['Job']['Turno']);
        $Contrato = FormatHelper::getContrato($data['Job']['Contrato']);
        $Horas = FormatHelper::getHoras($data['Job']['Horas']);
        $Principal = $data['Job']['Principal'];

        DB::beginTransaction();

        try {

            $nombramiento = Personas_trabajo::where('id_persona', $Id)->where('principal', $Principal)->first();

            if ($nombramiento) {
                $nombramiento->update([
                    'nombramiento' => $data['Job']['Nombramiento'],
                    'distincion_ad' => $data['Job']['Adicional'],
                    'area_distincion' => $data['Job']['Adscripcion'],
                    'turno' => $Turno,
                    'horas_trabajo' => $Horas,
                    'horario_oficial' => $data['Job']['Oficial'],
                    'tipo_contrato' => $Contrato,
                    'fecha_termino' => $data['Job']['Termino'], 
                    'id_categoria' => $data['Job']['Categoria'],
                    'id_estado' => $data['Job']['Estado'],
                    'updated_by' => auth()->user()->id,
                    'semblanza'=> $data['Job']['Semblanza'],
                ]);
                $isSubjectTeacher = Nombramiento::where('nombre', 'LIKE', '%Profesor de Asignatura%')->first();

                if ($isSubjectTeacher->id == $data['Job']['Nombramiento']) {
                    $departamentos = $data['Job']['Departamentos'];
                    $nombramiento->departamento()->sync($departamentos);
                }
                DB::commit();
            }

            return response()->json(['status' => 200, 'msg' => '¡Exito! Los datos fueron actualizados correctamente.']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al cambiar los datos  nombramientos de la persona' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()], 404);
        }
    }
}
