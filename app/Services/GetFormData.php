<?php

namespace App\Services;

use App\Helpers\FormatHelper;
use App\Models\Administrativo;
use App\Models\Departamento;
use App\Models\Domicilio;
use App\Models\Nombramiento;
use Illuminate\Support\Facades\Log;
use Exception;
use LaravelLang\Publisher\Console\Add;

class GetFormData
{

    public static function getNombramientos()
    {
        try {

            $Jobs = Nombramiento::all();
 
            return  $Jobs;
        } catch (Exception $e) {
            Log::error('Error al consultar los datos de los nombramientos' . $e->getMessage());
            return $e;
        }
    }
    public static function getDepartamentos()
    {
        try {

             $departamentos = Departamento::all();

            return $departamentos;
        } catch (Exception $e) {
            Log::error('Error al consultar los datos de los nombramientos' . $e->getMessage());
            return $e;
        }
    }   
}
