<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Estado;
use App\Models\User;
use App\Models\Nombramiento;
use App\Models\Distincion_Adicional;
use App\Models\Administrativo;
use App\Models\Categoria;
use App\Models\persona_has_adicional;
use App\Models\Personas_trabajo;

class DatabaseSeeder extends Seeder{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        ////// NOMBRAMIENTOS
        $Nombramiento = [
            ['id' => 1, 'nombre' => 'Administrativo'],   // 1 
            ['id' => 2, 'nombre' => 'Operativo'],          // 2
            ['id' => 3, 'nombre' => 'Directivo'],
            ['id' => 4, 'nombre' => 'Profesores de Tiempo Completo'],
            ['id' => 5, 'nombre' => 'Técnicos Académicos'],
            ['id' => 6, 'nombre' => 'Profesor de Asignatura'],
        ]; 


        //////// ESTADOS 
        $Estados = [
            ['nombre' => 'Activo'],
            ['nombre' => 'De licencia'],
            ['nombre' => 'Incapacidad'],
            ['nombre' => 'Traslado'],
            ['nombre' => 'Inactivo'],

        ];

        ////// ADMINISTRATIVOS

        // $Administrativos = [
        //     ['codigo' => '2946442', 'nombre' => 'ACEVES ALDRETE CESAR EDUARDO', 'fecha_nacimiento' => '1995-01-01', 'fecha_ingreso' => '2008-10-10', 'sexo' => 'Masculino', 'ultimo_grado' => 'Maestría', 'estado_id' => 1, 'correo' => "example@gmail.com", 'tel_emergencia' => "4444444444", "nombre_emergencia" => "Mauricio Aguilar"],
        //     ['codigo' => '2950008', 'nombre' => 'CORNEJO GUTIÉRREZ FERNANDO', 'fecha_nacimiento' => '1995-01-01', 'fecha_ingreso' => '2008-10-10', 'sexo' => 'Masculino', 'ultimo_grado' => 'Maestría', 'estado_id' => 1, 'correo' => "example@gmail.com", 'tel_emergencia' => "3789654123", "nombre_emergencia" => "Horacio"],
        //     ['codigo' => '2962471', 'nombre' => 'CRUZ FRANCO CARLOS JAVIER', 'fecha_nacimiento' => '1995-01-01', 'fecha_ingreso' => '2008-10-10', 'sexo' => 'Masculino', 'ultimo_grado' => 'Maestría', 'estado_id' => 1, 'correo' => "example@gmail.com", 'tel_emergencia' => "3789654874", "nombre_emergencia" => "Estela Garcia"],
        //     ['codigo' => '2225816', 'nombre' => 'FRANCO CASILLAS SERGIO', 'fecha_nacimiento' => '1995-01-01', 'fecha_ingreso' => '2008-10-10', 'sexo' => 'Masculino', 'ultimo_grado' => 'Doctorado', 'estado_id' => 1, 'correo' => "example@gmail.com", 'tel_emergencia' => "3789654123", "nombre_emergencia" => "Griselda Martín" ],
        //     ['codigo' => '2806533', 'nombre' => 'GÓMEZ COSÍO BEATRIZ IDIANA', 'fecha_nacimiento' => '1995-01-01', 'fecha_ingreso' => '2008-10-10', 'sexo' => 'Femenino', 'ultimo_grado' => 'Maestría', 'estado_id' => 1, 'correo' => "example@gmail.com",'tel_emergencia' => "3789652154", "nombre_emergencia" => "Miriam"],
        //     ['codigo' => '2967353', 'nombre' => 'GONZÁLEZ RODRIGUEZ YOLANDA ROSINA', 'fecha_nacimiento' => '1995-01-01', 'fecha_ingreso' => '2008-10-10', 'sexo' => 'Femenino', 'ultimo_grado' => 'Maestría', 'estado_id' => 2, 'correo' => "example@gmail.com",'tel_emergencia' => "3789654120", "nombre_emergencia" => "María de Jesús"],
        //     ['codigo' => '2726319', 'nombre' => 'GONZÁLEZ CERVANTES JUAN LUIS', 'fecha_nacimiento' => '1995-01-01', 'fecha_ingreso' => '2008-10-10', 'sexo' => 'Masculino', 'ultimo_grado' => 'Maestría', 'estado_id' => 1, 'correo' => "example@gmail.com",'tel_emergencia' => "3786201520", "nombre_emergencia" => "Olga salazar"],
        //     ['codigo' => '2830892', 'nombre' => 'MACIEL DELGADO ERNESTO', 'fecha_nacimiento' => '1995-01-01', 'fecha_ingreso' => '2008-10-10', 'sexo' => 'Masculino', 'ultimo_grado' => 'Licenciatura', 'estado_id' => 1, 'correo' => "example@gmail.com", 'tel_emergencia' => "3789652145", "nombre_emergencia" => "Efrain Ruvalcaba"],
        //     ['codigo' => '2952838', 'nombre' => 'NAVARRO DÍAZ EDUARDO', 'fecha_nacimiento' => '1995-01-01', 'fecha_ingreso' => '2008-10-10', 'sexo' => 'Masculino', 'ultimo_grado' => 'Licenciatura', 'estado_id' => 1, 'correo' => "example@gmail.com",'tel_emergencia' => "3789587458", "nombre_emergencia" => "Samuel Delgadillo"],
        //     ['codigo' => '9205195', 'nombre' => 'RAMÍREZ RODRÍGUEZ VIRGINIA', 'fecha_nacimiento' => '1995-01-01', 'fecha_ingreso' => '2008-10-10', 'sexo' => 'Femenino', 'ultimo_grado' => 'Maestría', 'estado_id' => 1, 'correo' => "example@gmail.com",'tel_emergencia' => "3789654120", "nombre_emergencia" => "Claudia Loza"],
        //     ['codigo' => '2921073', 'nombre' => 'SOLANO GUZMÁN EDUARDO', 'fecha_nacimiento' => '1995-01-01', 'fecha_ingreso' => '2008-10-10', 'sexo' => 'Masculino', 'ultimo_grado' => 'Maestría', 'estado_id' => 1, 'correo' => "example@gmail.com",'tel_emergencia' => "3789654123", "nombre_emergencia" => "Oscal De Loa"],

        // ];

        User::create([
            'name' => 'LOMELI ZERMEÑO JAZMIN',
            'user_name' => '2166104',
            'password' => Hash::make('Aa@1'),
        ])->assignRole(2);

        $this->call(RolDesignerSeeder::class);

        User::where('user_name', '010101')->first()->assignRole(1);
        
        // User::create([
        //     'name' => 'CTA',
        //     'user_name' => '010101',
        //     'password' => Hash::make('Aa@1'),
        // ])->assignRole(1);

       

        /////// DISTINCION ADICIONAL
        $Distincion = [
            ['nombre' => 'SNII Candidato'],
            ['nombre' => 'SNII 1'],
            ['nombre' => 'SNII 2'],
            ['nombre' => 'SNII 3'],
            ['nombre' => 'SNII Emérito'],
        ];

       

        /////// CATEGORIAS   1 masculino  2  femenino  3 ambos
        $Categorias = [
            ['genero' => 3, 'id_nombramiento' => 1, 'nombre' => 'Auxiliar General'],
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Administrativo de Apoyo'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Administrativa de Apoyo'],
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Administrativo de Coordinación'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Administrativa de Coordinación'],
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Técnico de Coordinación'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Técnica de Coordinación'],
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Auxiliar Administrativo D'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Auxiliar Administrativa D'],
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Técnico Administrativo A'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Técnica Administrativa A'],
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Técnico Administrativo B'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Técnica Administrativa B'],
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Técnico Administrativo C'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Técnica Administrativa C'],
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Técnico Administrativo D'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Técnica Administrativa D'],
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Técnico Administrativo E'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Técnica Administrativa E'],
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Técnico Profesional C'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Técnica Profesional C'],
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Jefe de Control B'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Jefa de Control B'],
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Jefe de Unidad B'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Jefa de Unidad B'],
            // Jefe de Unidad Administrativa B
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Jefe de Unidad A'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Jefa de Unidad A'],
            //Jefe de Unidad Administrativa B
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Jefe de Apoyo Administrativo'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Jefa de Apoyo Administrativo'],
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Jefe de Apoyo Técnico'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Jefa de Apoyo Técnico'],
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Jefe Operativo'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Jefa Operativo'],
            ['genero' => 1, 'id_nombramiento' => 1, 'nombre' => 'Jefe Operativo Especializado'],
            ['genero' => 2, 'id_nombramiento' => 1, 'nombre' => 'Jefa Operativo Especializado'],

            ['genero' => 3, 'id_nombramiento' => 2, 'nombre' => 'Auxiliar General'],   // ambos
            ['genero' => 1, 'id_nombramiento' => 2, 'nombre' => 'Auxiliar Operativo D'],
            ['genero' => 2, 'id_nombramiento' => 2, 'nombre' => 'Auxiliar Operativa D'],
            ['genero' => 1, 'id_nombramiento' => 2, 'nombre' => 'Administrativo de Apoyo'],
            ['genero' => 2, 'id_nombramiento' => 2, 'nombre' => 'Administrativa de Apoyo'],
            ['genero' => 1, 'id_nombramiento' => 2, 'nombre' => 'Jefe de Apoyo Administrativo'],
            ['genero' => 2, 'id_nombramiento' => 2, 'nombre' => 'Jefa de Apoyo Administrativo'],
            ['genero' => 1, 'id_nombramiento' => 2, 'nombre' => 'Jefe de Apoyo Técnico'],
            ['genero' => 2, 'id_nombramiento' => 2, 'nombre' => 'Jefa de Apoyo Técnico'],
            ['genero' => 1, 'id_nombramiento' => 2, 'nombre' => 'Técnico Operativo C'],
            ['genero' => 2, 'id_nombramiento' => 2, 'nombre' => 'Técnica Operativa C'],

            ['genero' => 1, 'id_nombramiento' => 3, 'nombre' => 'Rector'],
            ['genero' => 2, 'id_nombramiento' => 3, 'nombre' => 'Rectora'],
            ['genero' => 2, 'id_nombramiento' => 3, 'nombre' => 'Secretaria Particular de Rectoría'],
            ['genero' => 1, 'id_nombramiento' => 3, 'nombre' => 'Secretario Particular de Rectoría'],
            ['genero' => 1, 'id_nombramiento' => 3, 'nombre' => 'Secretario Académico'],
            ['genero' => 2, 'id_nombramiento' => 3, 'nombre' => 'Secretaria Académica'],    
            ['genero' => 1, 'id_nombramiento' => 3, 'nombre' => 'Secretario Administrativo'],
            ['genero' => 2, 'id_nombramiento' => 3, 'nombre' => 'Secretaria Administrativa'],    
            ['genero' => 1, 'id_nombramiento' => 3, 'nombre' => 'Director de División'],
            ['genero' => 2, 'id_nombramiento' => 3, 'nombre' => 'Directora de División'],
            ['genero' => 1, 'id_nombramiento' => 3, 'nombre' => 'Secretario División'],
            ['genero' => 2, 'id_nombramiento' => 3, 'nombre' => 'Secretaria División'],    
            ['genero' => 1, 'id_nombramiento' => 3, 'nombre' => 'Jefe de Departamento'],
            ['genero' => 2, 'id_nombramiento' => 3, 'nombre' => 'Jefa de Departamento'],   
            ['genero' => 1, 'id_nombramiento' => 3, 'nombre' => 'Coordinador de Área A'],
            ['genero' => 2, 'id_nombramiento' => 3, 'nombre' => 'Coordinadora de Área A'],    
            ['genero' => 1, 'id_nombramiento' => 3, 'nombre' => 'Jefe de Unidad C'],
            ['genero' => 2, 'id_nombramiento' => 3, 'nombre' => 'Jefa de Unidad C'],   
            ['genero' => 1, 'id_nombramiento' => 3, 'nombre' => 'Coordinador de Posgrado C'],
            ['genero' => 2, 'id_nombramiento' => 3, 'nombre' => 'Coordinadora de Posgrado C'],    
            ['genero' => 1, 'id_nombramiento' => 3, 'nombre' => 'Coordinador de Carrera'],
            ['genero' => 2, 'id_nombramiento' => 3, 'nombre' => 'Coordinadora de Carrera'],   
            ['genero' => 1, 'id_nombramiento' => 3, 'nombre' => 'Coordinador de Servicios A'],
            ['genero' => 2, 'id_nombramiento' => 3, 'nombre' => 'Coordinadora de Servicios A'],    
            ['genero' => 1, 'id_nombramiento' => 3, 'nombre' => 'Coordinador de Servicios B'],
            ['genero' => 2, 'id_nombramiento' => 3, 'nombre' => 'Coordinadora de Servicios B'],               
            ['genero' => 1, 'id_nombramiento' => 3, 'nombre' => 'Coordinador de Servicios C'],
            ['genero' => 2, 'id_nombramiento' => 3, 'nombre' => 'Coordinadora de Servicios C'],             
            ['genero' => 1, 'id_nombramiento' => 3, 'nombre' => 'Coordinador de Servicios D'],
            ['genero' => 2, 'id_nombramiento' => 3, 'nombre' => 'Coordinadora de Servicios D'],     
            ['genero' => 3, 'id_nombramiento' => 3, 'nombre' => 'Líder de Proyecto A'],
            ['genero' => 3, 'id_nombramiento' => 3, 'nombre' => 'Líder de Proyecto B'],
            ['genero' => 3, 'id_nombramiento' => 3, 'nombre' => 'Líder de Proyecto C'],


            
            ['genero' => 1, 'id_nombramiento' => 4, 'nombre' => 'Profesor de Tiempo Completo Asistente A'],
            ['genero' => 2, 'id_nombramiento' => 4, 'nombre' => 'Profesora de Tiempo Completo Asistente A'],
            ['genero' => 1, 'id_nombramiento' => 4, 'nombre' => 'Profesor de Tiempo Completo Asistente B'],
            ['genero' => 2, 'id_nombramiento' => 4, 'nombre' => 'Profesora de Tiempo Completo Asistente B'],
            ['genero' => 1, 'id_nombramiento' => 4, 'nombre' => 'Profesor de Tiempo Completo Asistente C'],
            ['genero' => 2, 'id_nombramiento' => 4, 'nombre' => 'Profesora de Tiempo Completo Asistente C'],
            ['genero' => 1, 'id_nombramiento' => 4, 'nombre' => 'Profesor de Tiempo Completo Asociado A'],
            ['genero' => 2, 'id_nombramiento' => 4, 'nombre' => 'Profesora de Tiempo Completo Asociado A'],
            ['genero' => 1, 'id_nombramiento' => 4, 'nombre' => 'Profesor de Tiempo Completo Asociado B'],
            ['genero' => 2, 'id_nombramiento' => 4, 'nombre' => 'Profesora de Tiempo Completo Asociado B'],
            ['genero' => 1, 'id_nombramiento' => 4, 'nombre' => 'Profesor de Tiempo Completo Asociado C'],
            ['genero' => 2, 'id_nombramiento' => 4, 'nombre' => 'Profesora de Tiempo Completo Asociado C'],
            ['genero' => 1, 'id_nombramiento' => 4, 'nombre' => 'Profesor de Tiempo Completo Titular A'],
            ['genero' => 2, 'id_nombramiento' => 4, 'nombre' => 'Profesora de Tiempo Completo Titular A'],
            ['genero' => 1, 'id_nombramiento' => 4, 'nombre' => 'Profesor de Tiempo Completo Titular B'],
            ['genero' => 2, 'id_nombramiento' => 4, 'nombre' => 'Profesora de Tiempo Completo Titular B'],
            ['genero' => 1, 'id_nombramiento' => 4, 'nombre' => 'Profesor de Tiempo Completo Titular C'],
            ['genero' => 2, 'id_nombramiento' => 4, 'nombre' => 'Profesora de Tiempo Completo Titular C'],
           
            ['genero' => 1, 'id_nombramiento' => 5, 'nombre' => 'Técnico Académico Asistente A'],
            ['genero' => 2, 'id_nombramiento' => 5, 'nombre' => 'Técnica Académica Asistente A'],
            ['genero' => 1, 'id_nombramiento' => 5, 'nombre' => 'Técnico Académico Asistente B'],
            ['genero' => 2, 'id_nombramiento' => 5, 'nombre' => 'Técnica Académica Asistente B'],
            ['genero' => 1, 'id_nombramiento' => 5, 'nombre' => 'Técnico Académico Asistente C'],
            ['genero' => 2, 'id_nombramiento' => 5, 'nombre' => 'Técnica Académica Asistente C'],
            ['genero' => 1, 'id_nombramiento' => 5, 'nombre' => 'Técnico Académico Asociado A'],
            ['genero' => 2, 'id_nombramiento' => 5, 'nombre' => 'Técnica Académica Asociada A'],
            ['genero' => 1, 'id_nombramiento' => 5, 'nombre' => 'Técnico Académico Asociado B'],
            ['genero' => 2, 'id_nombramiento' => 5, 'nombre' => 'Técnica Académica Asociada B'],
            ['genero' => 1, 'id_nombramiento' => 5, 'nombre' => 'Técnico Académico Asociado C'],
            ['genero' => 2, 'id_nombramiento' => 5, 'nombre' => 'Técnica Académica Asociada C'],
            ['genero' => 1, 'id_nombramiento' => 5, 'nombre' => 'Técnico Académico Titular A'],
            ['genero' => 2, 'id_nombramiento' => 5, 'nombre' => 'Técnica Académica Titular A'],
            ['genero' => 1, 'id_nombramiento' => 5, 'nombre' => 'Técnico Académico Titular B'],
            ['genero' => 2, 'id_nombramiento' => 5, 'nombre' => 'Técnica Académica Titular B'],
            ['genero' => 1, 'id_nombramiento' => 5, 'nombre' => 'Técnico Académico Titular C'],
            ['genero' => 2, 'id_nombramiento' => 5, 'nombre' => 'Técnica Académica Titular C'],

            ['genero' => 1, 'id_nombramiento' => 6, 'nombre' => 'Profesor de Asignatura A'],
            ['genero' => 2, 'id_nombramiento' => 6, 'nombre' => 'Profesora de Asignatura A'],
            ['genero' => 1, 'id_nombramiento' => 6, 'nombre' => 'Profesor de Asignatura B'],
            ['genero' => 2, 'id_nombramiento' => 6, 'nombre' => 'Profesora de Asignatura B'],
        ];

        $p_h_a = [
            ['id_nombramiento' => 4, 'id_distincion' => 1],
            ['id_nombramiento' => 4, 'id_distincion' => 2],
            ['id_nombramiento' => 4, 'id_distincion' => 3],
            ['id_nombramiento' => 4, 'id_distincion' => 4],
            ['id_nombramiento' => 4, 'id_distincion' => 5],
            ['id_nombramiento' => 5, 'id_distincion' => 1],
            ['id_nombramiento' => 5, 'id_distincion' => 2],
            ['id_nombramiento' => 5, 'id_distincion' => 3],
            ['id_nombramiento' => 5, 'id_distincion' => 4],
            ['id_nombramiento' => 5, 'id_distincion' => 5],
            ['id_nombramiento' => 6, 'id_distincion' => 1],
            ['id_nombramiento' => 6, 'id_distincion' => 2],
            ['id_nombramiento' => 6, 'id_distincion' => 3],
            ['id_nombramiento' => 6, 'id_distincion' => 4],
            ['id_nombramiento' => 6, 'id_distincion' => 5],
        ];
       
        // Estado::insert($Estados);
        // Administrativo::insert($Administrativos);
        // Nombramiento::insert($Nombramiento);
        // Distincion_Adicional::insert($Distincion);
        // persona_has_adicional::insert($p_h_a);
        // Categoria::insert($Categorias);
    }
}
