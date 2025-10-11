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
        Schema::create('honorarios', function (Blueprint $table) {
            $table->id();
            $table->string('area', 100);
            $table->string('responsable', 200);
            $table->string('rfc',13);
            $table->foreignId('administrativo_id')->constrained('administrativos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('honorarios', function(Blueprint $table){
            $table->dropForeign(['administrativo_id']);
        });

        Schema::dropIfExists('honorarios');
    }
};
