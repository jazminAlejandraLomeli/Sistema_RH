<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\Insert_WorkerRequest;


use App\Models\Nombramiento;

use App\Models\Departamento;

use App\Services\AddressDataService;
use App\Services\JobDataService;
use App\Services\LogsDataService;
use App\Services\PersonDataService;
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
            ['name' => 'personal', 'url' => route('worker.index')],
            ['name' => 'Agregar personal', '' => ''],
        ];

        $nombramientos = Nombramiento::all();
        $departamentos = Departamento::all();
        $route = route('worker.index');
        return view('workers.new-worker.new-worker', compact('nombramientos', 'departamentos', 'breadcrumbs', 'route'));
    }

    /* 
        Guardar un nuevo registro a la base de datos, hasta este punto ya se sabe si el codigo que se ingreso esta disponible
     */
    public function store(Insert_WorkerRequest $request)
    {

        //$data = $request->validated();
        $data = $request->all();
        $Personal = $data['Personal'];
        $Job = $data['Job'];
        $Address = $data['Address'];

        DB::beginTransaction();

        try {
            // Inserta persona principal
            $Administrativo = PersonDataService::save($Personal);
            $id_persona = $Administrativo->id;

            // Inserta trabajo
            $Job = JobDataService::save($Job, $id_persona);

            // Inserta domicilio (si aplica)
            $Address = AddressDataService::save($Address, $id_persona);
            // Logs
            LogsDataService::newWorker($Personal['Codigo'], $Personal['Nombre']);
        
            DB::commit();

            return response()->json([
                'status' => 200,
                'msg' => '¡Éxito! La persona fue agregada al sistema.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al agregar a la persona al sistema' . $e->getMessage());
            return response()->json(['status' => 404, 'msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()]);
        }
    }
}
