<?php

namespace App\Helpers;

use App\Models\Estado;

class FormatHelper
{
    public static function getSexo($genero)
    {
        $genders = collect(config('collections.sexo'));

        return $genders->firstWhere('id', (int)$genero)['nombre'] ?? null;
    }

    /*
    Funcion para obtener el id de un genero
*/
    public static function getSexoId($nombre)
    {
        $genders = collect(config('collections.sexo'));
       
        return $genders->firstWhere('nombre', ucfirst(strtolower($nombre)))['id'] ?? null;
    }

    public static function getTurno($turno)
    {
        $turnos = collect(config('work-collections.Shifts'));

        return $turnos->firstWhere('id', (int)$turno)['nombre'] ?? null;
    }

    public static function getContrato($contrato)
    {
        $Contracts = collect(config('work-collections.Contracts'));

        return $Contracts->firstWhere('id', (int)$contrato)['nombre'] ?? null;
    }

    public static function getHoras($horas)
    {
        $Hours = collect(config('work-collections.Hours'));

        return $Hours->firstWhere('id', (int)$horas)['nombre'] ?? null;
    }

    public static function getGrado($grado)
    {
        $grados = collect(config('collections.grados'));

        return $grados->firstWhere('id', (int)$grado)['nombre'] ?? null;
    }

/*
    Funcion para obtener el id de un grado
*/
    public static function getGradoId($nombre)
    {
        $grados = collect(config('collections.grados'));
       
        return $grados->firstWhere('nombre', ucfirst(strtolower($nombre)))['id'] ?? null;
    }


    public static function getState($estado)
    {
        $states = collect(config('collections.estados'));

        return $states->firstWhere('id', (int)$estado)['nombre'] ?? null;
    }

    public static function getStateId($nombre)
    {
        $states = collect(config('collections.estados'));

        return $states->firstWhere('nombre', ucfirst(strtolower($nombre)))['id'] ?? null;
    }
 




}
