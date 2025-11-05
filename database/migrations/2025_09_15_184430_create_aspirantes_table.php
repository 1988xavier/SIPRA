<?php 

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

    // ✅ Guardamos la carrera elegida
    $table->foreignId('carrera_principal_id')->nullable()
          ->constrained('carreras')
          ->nullOnDelete();

    $table->timestamps();
});
