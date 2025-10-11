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
         Schema::create('persona_has_adicional', function (Blueprint $table) {
            $table->foreignId('id_nombramiento')->constrained('nombramientos');     
            $table->foreignId('id_distincion')->constrained('distincion_adicional');     

         });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('persona_has_adicional', function (Blueprint $table) {
            $table->dropForeign(['id_nombramiento']);
            $table->dropForeign(['id_distincion']);
        });
        
        Schema::dropIfExists('persona_has_adicional');
    }
};
