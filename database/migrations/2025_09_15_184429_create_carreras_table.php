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
        Schema::create('carreras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('slug')->unique();
            $table->longText('descripcion')->nullable();
            $table->longText('objetivo')->nullable();
            $table->longText('perfil')->nullable();
            $table->longText('plan_estudio')->nullable();
            $table->longText('desarrollo_profesional')->nullable();
            $table->longText('competencias')->nullable();
            $table->longText('requisitos')->nullable();
          
            $table->string('video')->nullable();
            $table->json('imagen')->nullable();
            $table->unsignedBigInteger('vistas')->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carreras');
    }
};
