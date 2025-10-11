<?php

namespace App\Helpers;

use App\Models\Administrativo;
use Illuminate\Database\Eloquent\Collection;

class GeneralFunction
{

    protected static $grados = [
            ['id' => 1, 'nombre' => 'Primaria'],
            ['id' => 2, 'nombre' => 'Secundaria'],
            ['id' => 3, 'nombre' => 'Bachillerato'],
            ['id' => 4, 'nombre' => 'Carrera técnica'],
            ['id' => 5, 'nombre' => 'Licenciatura/Ingeniería'],
            ['id' => 6, 'nombre' => 'Especialidad'],
            ['id' => 7, 'nombre' => 'Maestría'],
            ['id' => 8, 'nombre' => 'Doctorado'],
            ['id' => 9, 'nombre' => 'Sin estudios'],
        ];

        protected static $sexos = [
            ['id' => 1, 'nombre' => 'Masculino'],
            ['id' => 2, 'nombre' => 'Femenino'],
        ];
    
    public static function generarCodigoUnico(): int
    {
        // Verificar que el codigo no exista
        do {
            $codigo = random_int(1000000, 9999999);
        } while (Administrativo::where('codigo', $codigo)->exists());

        return $codigo;
    }

    public static function obtenerDatosFormularioPersonal(): object
    {
        // Mapear el grado
              
        return (object)[
            'grado' => collect(self::$grados),
            'sexo' =>  collect(self::$sexos)
        ];
    }

    public static function obtenerDatosSexoSeleccionado($nombre): int
    {
        $sexoSeleccionado = collect(self::$sexos)->firstWhere('nombre', $nombre)['id'] ?? null;        
        return $sexoSeleccionado;
    }

    public static function obtenerDatosGradoSeleccionado($nombre): int
    {
        $gradoSeleccionado = collect(self::$grados)->firstWhere('nombre', $nombre)['id'] ?? null;        
        return $gradoSeleccionado;
    }

}
