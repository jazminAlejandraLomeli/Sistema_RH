<?php

namespace App\Services;

use App\Helpers\FormatHelper;
use App\Models\Administrativo;
use Exception;
use LaravelLang\Publisher\Console\Add;

class PersonDataService
{

    public static function save(array $data, $id = null)
    {

        $Genero = FormatHelper::getSexo($data['Genero']);
        $Grado = FormatHelper::getGrado($data['Estudios']);

        $Data = [
            'codigo' => $data['Codigo'],
            'sexo' =>  $Genero,
            'nombre' => strtoupper($data['Nombre']),
            'fecha_nacimiento' => $data['F_nacimiento'],
            'fecha_ingreso' => $data['F_ingreso'],
            'ultimo_grado' => $Grado,
            'correo' => $data['Correo'],
            'telefono' => $data['Telefono'],
            'nombre_emergencia' => $data['Nombre_e'],
            'e_parentesco' => $data['Parentesco'],
            'tel_emergencia' => $data['Tel_emer'],
            'nss' => $data['Nss'] ?? null,
            'rfc' => $data['RfC'] ?? null,
            'estado_id' => 1,
            'created_by' => auth()->user()->id,
        ];

        if ($id) {
            //  UPDATE
            $persona = Administrativo::findOrFail($id);
            $persona->update($Data);
        } else {
            //  CREATE
            $persona = Administrativo::create($Data);
        }

        if (!$persona) {
            throw new Exception('No se pudo guardar toda la información');
        }

        return $persona;
      
    }
    public static function update(array $data, $id)
    {

        $Genero = FormatHelper::getSexo($data['Genero']);
        $Grado = FormatHelper::getGrado($data['Estudios']);

        $Data = [
            'codigo' => $data['Codigo'],
            'sexo' =>  $Genero,
            'nombre' => strtoupper($data['Nombre']),
            'fecha_nacimiento' => $data['F_nacimiento'],
            'fecha_ingreso' => $data['F_ingreso'],
            'ultimo_grado' => $Grado,
            'correo' => $data['Correo'],
            'telefono' => $data['Telefono'],
            'nombre_emergencia' => $data['Nombre_e'],
            'e_parentesco' => $data['Parentesco'],
            'tel_emergencia' => $data['Tel_emer'],
            'nss' => $data['Nss'] ?? null,
            'rfc' => $data['Rfc'] ? strtoupper($data['Rfc']) : null,

            'estado_id' => $data['Status'] ?? 1,
            'created_by' => auth()->user()->id,
            'updated_by' => $data['Status'] ? auth()->user()->id : null,
        ];

        if ($id) {
            //  UPDATE
            $persona = Administrativo::findOrFail($id);
            $persona->update($Data);
        } else {
            //  CREATE
            $persona = Administrativo::create($Data);
        }

        if (!$persona) {
            throw new Exception('No se pudo guardar toda la información');
        }

        return $persona;
      
    }
    public static function getWorker($id){
        $persona = Administrativo::with([ 'estado'])->findOrFail($id);
        // Formatear datos para mostrarlos en el formulario
        $persona->sexo = FormatHelper::getSexoId($persona->sexo);
        $persona->ultimo_grado = FormatHelper::getGradoId($persona->ultimo_grado);

         return $persona;
    }
}
