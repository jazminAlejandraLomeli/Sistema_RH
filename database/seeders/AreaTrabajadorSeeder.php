<?php

namespace Database\Seeders;

use App\Models\AreaTrabajo;
use App\Models\Jerarquia;
use App\Models\Personas_trabajo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaTrabajadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trabajos = Personas_trabajo::all();

        $trabajos->each(function ($personas) { 
            $jerarquia = Jerarquia::where('area_distincion', $personas->area_distincion)->first();

            AreaTrabajo::create([
                'trabajo_id' => $personas->id,
                'jerarquia_id' => $jerarquia->id,
            ]);
        });
    }
}
