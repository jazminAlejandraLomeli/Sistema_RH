<?php

namespace App\Helpers;

class FormatHelper
{
    public static function getSexo($genero)
    {
        $sexos = [
            '1' => 'Masculino',
            '2' => 'Femenino',
        ];

        return $sexos[$genero] ?? null;
    }

    public static function getTurno($turno)
    {
        $turnos = [
            '1' => 'Matutino',
            '2' => 'Vespertino',
            '3' => 'Nocturno',
            '4' => 'Mixto',
            '5' => 'No aplica',
        ];

        return $turnos[$turno] ?? null;
    }

    public static function getContrato($contrato)
    {
        $contratos = [
            '1' => 'Temporal',
            '2' => 'Interinato',
            '3' => 'Definitivo',
        ];

        return $contratos[$contrato] ?? null;
    }

    public static function getHoras($horas)
    {
        $horasMap = [
            '1' => '20',
            '2' => '24',
            '3' => '36',
            '4' => '40',
            '5' => '48',
            '6' => 'No aplica',
            '7' => 'Carga 0',
        ];

        return $horasMap[$horas] ?? null;
    }

    public static function getGrado($grado)
    {
        $grados = [
            '1' => 'Primaria',
            '2' => 'Secundaria',
            '3' => 'Bachillerato',
            '4' => 'Carrera técnica',
            '5' => 'Licenciatura/Ingeniería',
            '6' => 'Especialidad',
            '7' => 'Maestría',
            '8' => 'Doctorado',
            '9' => 'Sin estudios',
        ];

        return $grados[$grado] ?? null;
    }
}
