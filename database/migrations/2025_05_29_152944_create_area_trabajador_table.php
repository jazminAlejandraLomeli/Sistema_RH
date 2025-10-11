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
        Schema::create('area_trabajador', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajo_id')->constrained('personas_trabajo');
            $table->foreignId('jerarquia_id')->constrained('jerarquias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('area_trabajador', function (Blueprint $table) {
            $table->dropForeign(['trabajo_id', 'jerarquia_id']);
        });

        Schema::dropIfExists('area_trabajador');
    }
};
