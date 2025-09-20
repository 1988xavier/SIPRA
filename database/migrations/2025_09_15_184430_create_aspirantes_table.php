<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirantes', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('escuela_procedencia')->nullable();
            $table->string('telefono')->nullable();

            $table->string('email')->unique();
            $table->string('password');

            $table->enum('status', ['proceso', 'aceptado', 'rechazado'])->default('proceso');

            $table->boolean('accepted_terms')->default(false);
            $table->timestamp('verified_at')->nullable();

            $table->timestamps();

            // database/migrations/xxxx_xx_xx_create_aspirantes_table.php
            $table->unsignedBigInteger('carrera_principal_id')->nullable();
            $table->foreign('carrera_principal_id')->references('id')->on('carreras')->onDelete('set null');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirantes');
    }
};
