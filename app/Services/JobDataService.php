<?php

namespace App\Services;

use App\Helpers\FormatHelper;
use App\Http\Controllers\Personas_TrabajoController;
use App\Models\Administrativo;
use App\Models\Categoria;
use App\Models\Departamento;
use App\Models\Distincion_Adicional;
use App\Models\Estado;
use App\Models\Log;
use App\Models\Nombramiento;
use App\Models\Personas_trabajo;
use Exception;
use LaravelLang\Publisher\Console\Add;

class JobDataService
{

    /*
        Guardar un nuevo registro a la base de datos, hasta este punto ya se sabe si el codigo que se ingreso esta disponible
    */
    public static function save(array $data, $id_persona, $principal = 1)
    {

        $Turno = FormatHelper::getTurno($data['Turno']);
        $Contrato = FormatHelper::getContrato($data['Contrato']);
        $Horas = FormatHelper::getHoras($data['Horas']);
        //  $id = $id_persona;

        $Data = [
            'id_persona' => $id_persona,
            'principal' => $principal,
            'nombramiento' => $data['Nombramiento'],
            'id_categoria' => $data['Categoria'],
            'horas_trabajo' => $Horas,
            'turno' => $Turno,
            'horario_oficial' => $data['Oficial'],
            'tipo_contrato' => $Contrato,
            'fecha_termino' => $data['Vencimiento'],
            'area_distincion' => $data['Adscripcion'],
            'distincion_ad' => $data['Adicional'],
            'id_estado' => 1,
            'semblanza' => $data['Semblanza'],
            'created_by' => auth()->user()->id,
        ];

        // create
        $Job = Personas_trabajo::create($Data);

        // Tabla pivote en caso de tener departamentos 
        $isSubjectTeacher = Nombramiento::where('nombre', 'LIKE', '%Profesor de Asignatura%')->first();

        if ($isSubjectTeacher->id == $data['Nombramiento']) {
            $departamentos = $data['Departamentos'];
            $Job->departamento()->attach($departamentos);
        }

        if (!$Job) {
            throw new Exception('No se pudo guardar la información del trabajo');
        }

        return $Job;
    }

    /*
     Actualizar los datos de un nombramiento 
    */
    public static function update(array $data, $id_trabajo, $principal = 1)
    {

        $Turno = FormatHelper::getTurno($data['Turno']);
        $Contrato = FormatHelper::getContrato($data['Contrato']);
        $Horas = FormatHelper::getHoras($data['Horas']);
        $semblanza = $data['Semblanza'];


        if ($data['Nombramiento'] < 4) {
            $semblanza = null;
        }

        $Data = [

            'principal' => $principal,
            'nombramiento' => $data['Nombramiento'],
            'id_categoria' => $data['Categoria'],
            'horas_trabajo' => $Horas,
            'turno' => $Turno,
            'horario_oficial' => $data['Oficial'],
            'tipo_contrato' => $Contrato,
            'fecha_termino' => $data['Vencimiento'],
            'area_distincion' => $data['Adscripcion'],
            'distincion_ad' => $data['Adicional'],
            'id_estado' => $data['Status'],
            'semblanza' => $semblanza,
            'updated_by' => auth()->user()->id,
        ];


        //  id_trabajo
        $Job = Personas_trabajo::findOrFail($id_trabajo);
        $Job->update($Data);

        // Tabla pivote en caso de tener departamentos 
        $isSubjectTeacher = Nombramiento::where('nombre', 'LIKE', '%Profesor de Asignatura%')->first();

        // Si el nombramiento actual es "Profesor de Asignatura"
        if ($isSubjectTeacher && $isSubjectTeacher->id == $data['Nombramiento']) {
            $departamentos = $data['Departamentos'] ?? [];
            $Job->departamento()->sync($departamentos);
        } else {
            // Si no aplica, limpia los departamentos por si antes tenía
            $Job->departamento()->sync([]);
        }



        if (!$Job) {
            throw new Exception('No se pudo actualizar la información del trabajo');
        }

        return $Job;
    }
    public static function getWorker($id)
    {

        try {
            $persona = Personas_trabajo::with([
                'administrativo',
                'nombramientoPersona',
                'estado',
                'distincionAdicional',
                'trabajoCategoria',
                'departamento'
            ])->findOrFail($id);
        } catch (Exception $e) {
            $persona = null;
        }

        return $persona;
    }

    /*
     Obtener si es el nombramiento principal o secundario 
    */
    public static function getMainOrSecond($Data)
    {

        if ($Data->principal == 1) {
            return [
                "title" => "Actualizar nombramiento principal",
                "nombramiento" => 1
            ];
        } else {
            return [
                "title" => "Actualizar nombramiento secundario",
                "nombramiento" => 0
            ];
        }
    }

    /*
     Obtener las categorias actuales 
    */
    public static function getDataForm($id_nombramiento, $gender)
    {

        // Datos para el formulario 
        $nombramientos = Nombramiento::all();
        $departamentos = Departamento::all();
        $Distinciones = Distincion_Adicional::all();
        $Estados = Estado::all();

        $categories = Categoria::where('id_nombramiento', $id_nombramiento)->where('genero', $gender)
            ->orderBy('nombre', 'asc')
            ->get();

        return [
            'categories' => $categories,
            'nombramientos' => $nombramientos,
            'departamentos' => $departamentos,
            'Distinciones' => $Distinciones,
            'Estados' => $Estados,
        ];
    }

    /*
     Eliminar un nombramiento, en caso de ser el secunadrio solo borra
        en caso de ser el principal y contar con dos el secunadrio pasa a ser el principal 
*/
    public static function delete($Data)
    {
        // 0 secundario 1 Principal
        $Principal = $Data['Principal'];
        $Id_work = $Data['Id_work'];
        $Id_worker = $Data['Id_worker'];

        if ($Principal === 0) { // secundario (SOLO BORRAR)
            $Trabajo = Personas_trabajo::where('id', $Id_work)->first();

            if ($Trabajo->nombramiento == 6) { ///  si es Profesor de asignatura se borra la tabla pivote
                $Trabajo->departamento()->detach();
            }
            $Trabajo->delete();  // Borrar registro
        } else { // Borramos el principal 
            //Contar cuantos nombramientos tiene la persona
            $Trabajos = Personas_trabajo::where('id_persona', $Id_worker)->count();

            $Trabajo = Personas_trabajo::where('id', $Id_work)->first();
            if ($Trabajo->nombramiento == 6) { ///  si es Profesor de asignatura se borra la tabla pivote
                $Trabajo->departamento()->detach();
            }
            $Trabajo->delete();  // Borrar registro

            if ($Trabajos === 2) {  // Tiene 2 nombramientos el secundario pasa a ser le principal 
                // Secundario pasa a ser el principal  
                $change_principal = Personas_trabajo::where('id_persona', $Id_worker)->first();
                $change_principal->principal = 1;
                $change_principal->save();
            }
        }
    }

    public static function switch($Data)
    {
        $Id_work = $Data['Id_work'];
         try {
            // Buscar el trabajo que se va a marcar como principal
            $secondTOfirst = Personas_trabajo::find($Id_work);

            if ($secondTOfirst) {
                $FirstTOsecond = Personas_trabajo::where('id_persona', $secondTOfirst->id_persona)
                    ->where('principal', 1)
                    ->first();
             
                if ($FirstTOsecond) {
                    $FirstTOsecond->principal = 0;
                    $FirstTOsecond->save();
                }

              
                $secondTOfirst->principal = 1;
                $secondTOfirst->save();
            }
        } catch (Exception $e) {
            Log::error('Error al cambiar el nombramiento' . $e->getMessage());
        }
    }
}
