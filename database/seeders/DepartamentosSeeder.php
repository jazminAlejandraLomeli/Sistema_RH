<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['nombre' => 'JURIDICOS (A 10)'],
            ['nombre' => 'DEO (A 20)'],
            ['nombre' => 'SALUD (B 10)'],
            ['nombre' => 'CLINICAS (B 20)'],
            ['nombre' => 'PECUARIAS (C 10)'],
            ['nombre' => 'INGENIERIAS (C 20)']
        ];

        Departamento::insert($data);
    }
}
