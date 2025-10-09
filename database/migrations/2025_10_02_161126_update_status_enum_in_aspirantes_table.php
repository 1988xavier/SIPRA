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
    Schema::table('aspirantes', function (Blueprint $table) {
        $table->enum('status', [
            'proceso',
            'contactado',
            'registrado',
            'no_registrado'
        ])->default('proceso')->change();
    });
}

public function down(): void
{
    Schema::table('aspirantes', function (Blueprint $table) {
        $table->enum('status', ['proceso', 'aceptado', 'rechazado'])->default('proceso')->change();
    });
}

};
