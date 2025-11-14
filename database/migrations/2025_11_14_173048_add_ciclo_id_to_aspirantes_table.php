<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('aspirantes', function (Blueprint $table) {
        $table->unsignedBigInteger('ciclo_id')->nullable()->after('id');

        // Llave foránea opcional (solo funciona si la tabla ciclos_promocion ya existe)
        $table->foreign('ciclo_id')
              ->references('id')
              ->on('ciclos_promocion')
              ->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('aspirantes', function (Blueprint $table) {
        $table->dropForeign(['ciclo_id']);
        $table->dropColumn('ciclo_id');
    });
}

};
