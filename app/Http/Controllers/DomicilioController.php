<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatesAddresRequest;
use App\Models\Domicilio;
use App\Services\AddressDataService;
use App\Services\LogsDataService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DomicilioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(Domicilio $domicilio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {

            $breadcrumbs = [
                ['name' => 'Inicio', 'url' => route('home.index')],
                ['name' => 'Personal', 'url' => route('worker.index')],
                ['name' => 'Detalles', 'url' => route('worker.detalles.mostrar', $id)],
                ['name' => 'Editar Domicilio'],
            ];

            $Worker = AddressDataService::getWorker($id);
            $gender = "";
            $Title = "Actualizar domicilio";
             // return response()->json($Worker);
            return view('workers.details.update.address', compact('breadcrumbs', 'Worker', 'gender', 'Title'));
        } catch (Exception $e) {
            Log::error('Error al obtener los datos del domicilio ' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesAddresRequest $Data)
    {
        
        try {

            $Address = $Data['Address'];
            $Id_address = intval($Address['Id_address'] ?? 0);
            $id_persona = intval($Address['Id']);

            DB::beginTransaction();

            // Insert
            if ($Id_address === 0) {
                // Inserta domicilio (si aplica)
                $Address = AddressDataService::save($Address, $id_persona);
                $msg = "Domicilio agregado correctamente.";
               LogsDataService::create_address($id_persona);
            } else {
                // Update
                $Address = AddressDataService::update($Address);
                $msg = "Domicilio actualizado correctamente.";
                LogsDataService::update_address($id_persona);
            }


             DB::commit();

            return response()->json([
                'status' => 200,
                'msg' => $msg
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar los datos del trabajador ' . $e->getMessage());
            return response()->json(['msg' => '¡Error!, Algo salió mal, inténtalo más tarde.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domicilio $domicilio)
    {
        //
    }
}
