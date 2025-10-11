<?php

namespace Database\Seeders;

use App\Models\Jerarquia;
use App\Models\Personas_trabajo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JerarquiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trabajos = Personas_trabajo::distinct();
        $index = 1;
        $trabajos->each(function ($personas) use ($index) {
            Jerarquia::create([
                'jerarquia' => $index,
                'area_distincion' => $personas->area_distincion
            ]);
        });
    }
}
