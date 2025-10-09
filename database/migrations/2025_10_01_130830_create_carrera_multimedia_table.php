<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carrera_multimedia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carrera_id')->constrained('carreras')->onDelete('cascade');
            $table->enum('tipo', ['imagen', 'video']);
            $table->string('ruta');
            $table->integer('orden')->default(0); // opcional para carruseles
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrera_multimedia');
    }
};
