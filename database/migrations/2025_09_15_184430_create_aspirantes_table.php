<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('aspirantes', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email');
            $table->string('escuela_procedencia')->nullable();

            $table->enum('status', [
                'proceso',
                'contactado',
                'registrado',
                'no_registrado'
            ])->default('proceso');

            $table->boolean('accepted_terms')->default(false);

            // ✅ Carrera elegida
            $table->foreignId('carrera_principal_id')
                  ->nullable()
                  ->constrained('carreras')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aspirantes');
    }
};
