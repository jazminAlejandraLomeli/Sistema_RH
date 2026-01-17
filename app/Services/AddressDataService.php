<?php

namespace App\Services;

use App\Helpers\FormatHelper;
use App\Models\Administrativo;
use App\Models\Domicilio;

class AddressDataService
{

    public static function save(array $data, $id_persona)
    {

        $State = FormatHelper::getState(intval($data['Estado']));

        $Data = [
            'administrativo_id' => $id_persona,
            'estado' =>  $State,
            'calle' => $data['Calle'],
            'numero' => $data['Numero'],
            'colonia' => $data['Colonia'],
            'ciudad' => $data['Municipio'],
            'cp' => $data['CP'],
            'created_by' => auth()->user()->id,
        ];

        //  Verificar si todos los campos (excepto created_by y administrativo_id) están vacíos
        $datosLimpios = collect($Data)->except(['created_by', 'administrativo_id']);

        // Si todos están vacíos, no actualizar
        $emptyArray = $datosLimpios->filter(fn($value) => !empty($value))->isNotEmpty();

        if (!$emptyArray) {
            return null; //  retornar false 
        }

        //  CREATE
        $Address = Domicilio::create($Data);
        // Logs
        return $Address;
    }
    public static function update(array $data)
    {

        $Data = [
            'estado' =>  FormatHelper::getState($data['Estado']),
            'calle' => $data['Calle'],
            'numero' => $data['Numero'],
            'colonia' => $data['Colonia'],
            'ciudad' => $data['Municipio'],
            'cp' => $data['CP'],
            'created_by' => auth()->user()->id,
        ];

        //  Verificar si todos los campos (excepto created_by) están vacíos
        $datosLimpios = collect($Data)->except(['created_by']);

        // Si todos están vacíos, no actualizar
        $emptyArray = $datosLimpios->filter(fn($value) => !empty($value))->isNotEmpty();

        if (!$emptyArray) {
            return null; //  retornar false 
        }

        $Address = Domicilio::findOrFail($data['Id_address']);
        $Address->update($Data);

        return $Address;
    }

    public static function getWorker($id)
    {
        $persona = Administrativo::with(['estado', 'domicilio'])->findOrFail($id);

        if ($persona->domicilio) {
            $persona->domicilio->estado = FormatHelper::getStateId($persona->domicilio->estado);
        }

        return $persona;
    }
}
