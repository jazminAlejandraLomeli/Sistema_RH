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
        Schema::create('personas_trabajo', function (Blueprint $table) {
            // $table->string('codigo', 7); 
            $table->id(); 
            $table->foreignId('id_persona')->constrained('administrativos'); // Llave Foránea

            $table->foreignId('nombramiento')->constrained('nombramientos');    // FK de latabla nombramientos
            $table->integer('principal')->nullable(false);
            $table->string('horas_trabajo',20)->nullable(false);
            $table->string('turno', 10)->nullable(false);   // Matutino, vespertino, nocturno mixto
            $table->text('horario_oficial')->nullable(false);
        
            $table->string('tipo_contrato', 12)->nullable(false);
            $table->date('fecha_termino')->nullable(true);
            $table->foreignId('distincion_ad')->nullable()->constrained('distincion_adicional');
            $table->foreignId('id_estado')->constrained('estados')->nullable(false);
            $table->foreignId('id_categoria')->constrained('categorias');    // FK de la tabla de categorias
            $table->string('area_distincion')->nullable(true);
            // Definir la llave foránea
             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personas_trabajo', function (Blueprint $table) {
            $table->dropForeign(['id_persona']);
            $table->dropForeign(['nombramiento']);
            $table->dropForeign(['distincion_ad']);
            $table->dropForeign(['id_estado']);
            $table->dropForeign(['id_categoria']);
        });

        Schema::dropIfExists('personas_trabajo');
    }
};
