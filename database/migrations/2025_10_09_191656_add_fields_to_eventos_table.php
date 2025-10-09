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
    Schema::table('eventos', function (Blueprint $table) {
        $table->string('lugar')->nullable();
        $table->time('hora')->nullable();
        $table->string('coordinador1')->nullable();
        $table->string('coordinador2')->nullable();
        $table->string('coordinador3')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eventos', function (Blueprint $table) {
            //
        });
    }
};
