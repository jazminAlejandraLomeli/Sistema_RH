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
        Schema::table('administrativos', function (Blueprint $table) {
            $table->string('rfc', 13)->nullable(true);
            $table->string('nss', 11)->nullable(true);
            $table->string('telefono', 10)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('administrativos', function (Blueprint $table) {
            $table->dropColumn('rfc');
            $table->dropColumn('nss');
            $table->dropColumn('telefono');
        });
    }
};
