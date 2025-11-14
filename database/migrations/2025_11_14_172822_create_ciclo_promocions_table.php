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
    Schema::create('ciclos_promocion', function (Blueprint $table) {
        $table->id();

        // Año del ciclo, por ejemplo 2025
        $table->year('anio');

        // Fecha y hora en que se inició el ciclo
        $table->dateTime('fecha_inicio')->nullable();

        // Fecha y hora en que se cerró el ciclo
        $table->dateTime('fecha_cierre')->nullable();

        // Estado del ciclo: 'activo' o 'cerrado'
        $table->string('estado')->default('activo');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('ciclos_promocion');
}

};
