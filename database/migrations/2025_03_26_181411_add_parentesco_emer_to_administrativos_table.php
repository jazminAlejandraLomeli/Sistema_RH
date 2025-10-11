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
            $table->string('e_parentesco',150)->nullable();
            $table->foreignId('updated_by')->nullable()->default(null)->constrained('users');
            $table->foreignId('created_by')->nullable()->default(null)->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('administrativos', function (Blueprint $table) {
            $table->dropColumn('e_parentesco');
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['updated_by', 'created_by']);
         });
    }
};
