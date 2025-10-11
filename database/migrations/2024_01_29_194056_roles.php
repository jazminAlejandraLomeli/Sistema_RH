<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /// Crear los roles 
        $role1 = Role::create(['id' => 1, 'name' => 'Administrador']);
        $role2 = Role::create(['id' => 2, 'name' => 'Lectura']);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('roles'); 
    }
};
