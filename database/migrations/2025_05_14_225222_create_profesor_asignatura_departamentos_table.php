<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profesor_asignatura_departamentos', function (Blueprint $table) {            
            $table->foreignId('persona_trabajo_id')->constrained('personas_trabajo');
            $table->foreignId('departamento_id')->constrained('departamentos');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('profesor_asignatura_departamentos',function(Blueprint $table){
            $table->dropForeign(['persona_trabajo_id']);
            $table->dropForeign(['departamento_id']);            
        });

        Schema::dropIfExists('profesor_asignatura_departamentos');
    }
};
