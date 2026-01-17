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
        Schema::create('domicilios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('administrativo_id')->constrained('administrativos');
            $table->string('estado', 100)->nullable();
             $table->string('calle', 100)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('colonia', 100)->nullable();
            $table->string('ciudad', 100)->nullable();
            $table->string('cp', 5)->nullable();
             $table->unsignedBigInteger('created_by')->nullable()->consttrain('cascade');
            $table->unsignedBigInteger('updated_by')->nullable()->consttrain('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('domicilios', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['administrativo_id']);
            $table->dropForeign(['updated_by']);
            
        });
        
        Schema::dropIfExists('domicilios');
    }
};
