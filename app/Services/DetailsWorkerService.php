<?php

namespace App\Services;

use App\Helpers\FormatHelper;
use App\Models\Administrativo;
use App\Models\Domicilio;
use Illuminate\Support\Facades\Log;
use Exception;
use LaravelLang\Publisher\Console\Add;

class DetailsWorkerService
{

    public static function index($id_persona)
    {
        try {

            $Worker = Administrativo::with([
                'estado',
                'trabajos' => function ($query) {
                    $query->orderBy('principal', 'desc')
                        ->with(['nombramientoPersona', 'trabajoCategoria', 'distincionAdicional', 'departamento']);
                },
                'domicilio',
            ])->find($id_persona);

            if (!$Worker) {
                return false;
            }


            return $Worker;
        } catch (Exception $e) {
            Log::error('Error al consultar los datos del trabajador' . $e->getMessage());
            return $e;
        }
    }
}
