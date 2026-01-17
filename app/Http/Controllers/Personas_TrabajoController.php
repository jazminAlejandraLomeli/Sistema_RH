<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\Insert_jobRequest;
use App\Helpers\FormatHelper;
use App\Http\Requests\DeleteJobRequest;
use App\Http\Requests\SwitchJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Administrativo;
use App\Models\Personas_trabajo;
use App\Services\DetailsWorkerService;
use App\Services\GetFormData;
use App\Services\JobDataService;
use App\Services\LogsDataService;
use Exception;
use Illuminate\Support\Facades\Log;

class Personas_TrabajoController extends Controller
{

    /* 
        Funcion para agregarle un nombramirnto a una persona desde la vista de detalles 
        por ello aqui ya no se mandan los datos personales
    */
    public function storeJob(Insert_jobRequest $request)
    {

        $data = $request->validated();
        $Job = $data['Job'];
        $id_persona = $data['Id'];
        $principal = $data['principal'];
        $Nombramiento = $Job['Nombramiento'];

        try {
            DB::beginTransaction();

            $Job = JobDataService::save($Job, $id_persona, $principal);
            LogsDataService::add_job($id_persona, $principal, $Nombramiento);

            DB::commit();
            return response()->json([
                'status' => 200,
                'msg' => '¡Éxito! El nombramiento se agrego correctamente.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al agregar el nombramiento' . $e->getMessage());

            return response()->json(['status' => 404, 'msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()]);
        }
    }

    /* 
        Funcion que busca el código de la persona y si esta te redirige a la vista de detalles
    */
    public function details($id)
    {
        try {


            $breadcrumbs = [
                ['name' => 'Inicio', 'url' => route('home.index')],
                ['name' => 'Personal', 'url' => route('worker.index')],
                ['name' => 'Detalles'],
            ];

            $Worker = DetailsWorkerService::index($id);


            if ($Worker) {
                //  return response()->json($forms);
                return view('workers.details.index', compact('Worker', 'breadcrumbs'));
            } else {
                return redirect('/personal');
            }
        } catch (Exception $e) {
            Log::error('Error al obtener los datos del trabajador ' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }
    /*
    Funcion para agregar un nombramiento a una persona desde la vista de detalles 
    */

    public function addJob($id)
    {

        try {


            $breadcrumbs = [
                ['name' => 'Inicio', 'url' => route('home.index')],
                ['name' => 'Personal', 'url' => route('worker.index')],
                ['name' => 'Detalles', 'url' => route('worker.detalles.mostrar', $id)],
                ['name' => 'Agregar nombramiento'],
            ];

            $Worker = Administrativo::find($id);
            $gender = FormatHelper::getSexoId($Worker->sexo);
            $count = Personas_trabajo::where('id_persona', $id)->count();

            $nombramientos = GetFormData::getNombramientos();
            $departamentos = GetFormData::getDepartamentos();
            $Title = "Agregar nombramiento";
            $route = route('worker.detalles.mostrar', $id);
           //  return response()->json($count);
            return view('workers.details.job.add-job', compact('breadcrumbs', 'nombramientos', 'departamentos', 'Worker', 'gender', 'id', 'Title', 'count', 'route'));
        } catch (Exception $e) {
            Log::error('Error al obtener los datos del trabajador ' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {

        try {
            $breadcrumbs = [
                ['name' => 'Inicio', 'url' => route('home.index')],
                ['name' => 'Personal', 'url' => route('worker.index')],
                ['name' => 'Detalles', 'url' => route('worker.detalles.mostrar', $id)],
                ['name' => 'Editar Nombramientos'],
            ];

            $Data = JobDataService::getworker($id);  // Todos los datos del nombramiento

            if ($Data == null) {
                return redirect()->route('worker.detalles.mostrar', ['codigo' => $id]);
                // route('worker.detalles.mostrar', $id)
                //  return redirect()->route('worker.detalles.index', ['codigo' => $id]);
            }


            $Worker = $Data->administrativo;  // Datos de la platilla de resume 
            $gender = FormatHelper::getSexoId($Worker->sexo); // Genero en formato ID

            $nombramiento =  JobDataService::getMainOrSecond($Data);   // Verificar que nombramirnto es y ontener el titulo 
            $Title = $nombramiento['title'];
            $principal = $nombramiento['nombramiento'];

            $FormData = JobDataService::getDataForm($Data->nombramiento, $gender);

            // Compactar todo en un objeto 
            $Selects = [
                'nombramientos' => $FormData['nombramientos'],
                'departamentos' => $FormData['departamentos'],
                'gender' => $gender,
                'Title' => $Title,
                'Principal' => $principal,
                'C_Categories' => $FormData['categories'],
                'Distinciones' => $FormData['Distinciones'],
                'Estados' => $FormData['Estados'],
            ];

            // return response()->json($Data);
            return view('workers.details.update.job', compact('breadcrumbs', 'Worker',  'Selects', 'Data'));
        } catch (Exception $e) {
            Log::error('Error al editar el nombramiento ' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }

    /*
    Funcion para actualizar un nombramiento 
    */
    public function update(UpdateJobRequest $Data)
    {
        try {

            $Job = $Data['Job'];
            $id_trabajo = $Data['Id_work'];
            $Principal = $Data['Principal'];
            DB::beginTransaction();

           //   Actualiza el nombramiento 
            $Job_update = JobDataService::update($Job, $id_trabajo, $Principal);
            $Id_worker = $Data['Id_worker'];
            $Nombramiento = $Job['Nombramiento'];
           
            //   Inserta el log
            LogsDataService::Update_job($Id_worker,  $Principal, $Nombramiento);


            DB::commit();
            return response()->json([
                'status' => 200,
                'msg' => '¡Éxito! El nombramiento se actualizó correctamente.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al agregar el nombramiento' . $e->getMessage());

            return response()->json(['status' => 404, 'msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()]);
        }
    }
    /*
    Funcion para eliminar un nombramiento 
*/
    public function delete(DeleteJobRequest $Data)
    {
        try {

            DB::beginTransaction();


            LogsDataService::delete_job($Data['Id_worker'], $Data['Id_work']);
            JobDataService::delete($Data);
        
            DB::commit();
            return response()->json([
                'status' => 200,
                'msg' => '¡Éxito! El nombramiento se elimino correctamente.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar el nombramiento' . $e->getMessage());

            return response()->json(['status' => 404, 'msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()]);
        }
    }

    /*
    Funcion para Intercambiar los nombramientos 
    */
    public function switchJob(SwitchJobRequest $Data)
    {
        try {
            DB::beginTransaction();
            // Funcion que intercambia los nombramientos 
            JobDataService::switch($Data);
            LogsDataService::switch_job($Data['Id_worker']);

            DB::commit();
            return response()->json([
                'status' => 200,
                'msg' => '¡Éxito! Los nombramientos se intercambiaron correctamente.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar el nombramiento' . $e->getMessage());
            return response()->json(['status' => 404, 'msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()]);
        }
    }
}
