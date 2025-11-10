<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('carreras', function (Blueprint $table) {
        $table->string('facebook')->nullable();
        $table->string('tiktok')->nullable();
    });
}

public function down()
{
    Schema::table('carreras', function (Blueprint $table) {
        $table->dropColumn(['facebook', 'tiktok']);
    });
}
};
