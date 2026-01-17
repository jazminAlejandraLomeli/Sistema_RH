<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrativo;
use App\Models\Nombramiento;
use App\Models\Estado;
use App\Models\Personas_trabajo;
use App\Models\User;
use App\Services\BirthdaysService;
use App\Services\HomeService;
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

            $today = Carbon::today();
            $month = Carbon::now()->month;
             //  return response()->json($today);

            // Llamar al servicio para obtener datos
            $SqlTotals = HomeService::Data();  // sel general
            $totales = HomeService::Totals($SqlTotals); //  Contar totales a partir de $SqlTotals
            $CountContracts = HomeService::Contratos($SqlTotals); // Contar contratos a partir de $SqlTotals
            $t_honorarios = HomeService::GetHonorarios();   // Obtener honorarios segun su genero
            $statuses_contracts = HomeService::GetContracts($today, $month);   // Estados de los contratos 
            $Workers_statuses = HomeService::GetWorkers();  // Estados del personal con su genero

            $birthdays = BirthdaysService::getHBD($month);
            $hbd_today = BirthdaysService::getTodayHBD($today);


          //  return response()->json($hbd_today);

            return view('home', compact('totales', 'Workers_statuses', 'breadcrumbs', 't_honorarios', 'CountContracts', 'statuses_contracts', 'birthdays', 'hbd_today'));
        } catch (\Exception $e) {
            Log::error('Error al obtener los datos del sistema' . $e->getMessage());
            return response()->json(['msg' => '¡Error! Hubo un error al al realizar la petición, inténtalo más tarde.', 'error' => $e->getMessage()], 404);
        }
    }
}
