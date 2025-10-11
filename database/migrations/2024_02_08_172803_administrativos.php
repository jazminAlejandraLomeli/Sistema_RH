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
        Schema::create('administrativos', function (Blueprint $table) {
            $table->id();    // Primary
            $table->string('codigo', 7)->nullable(false);
            $table->string('nombre')->nullable(false);
            $table->string('correo')->nullable(false);
            $table->string('tel_emergencia', 10)->nullable(true);
            $table->string('nombre_emergencia', 50)->nullable(true);
            $table->date('fecha_nacimiento')->nullable(false);
            $table->date('fecha_ingreso')->nullable(false);
            $table->string('sexo', 10)->nullable(false);
            $table->string('ultimo_grado')->nullable(false);
            $table->foreignId('estado_id')->constrained('estados');   // FK de tabla estados
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('administrativos', function (Blueprint $table) {
            $table->dropForeign(['estado_id']);
        });
        
        Schema::dropIfExists('administrativos');
    }
};
