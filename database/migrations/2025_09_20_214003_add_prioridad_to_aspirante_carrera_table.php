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
        Schema::table('aspirante_carrera', function (Blueprint $table) {
            $table->tinyInteger('prioridad')->default(1)->after('carrera_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aspirante_carrera', function (Blueprint $table) {
            $table->dropColumn('prioridad');
        });
    }
};
