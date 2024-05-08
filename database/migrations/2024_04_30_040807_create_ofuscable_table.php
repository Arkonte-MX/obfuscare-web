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
        Schema::create('ofuscable', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('valor', 64)->unique();
            $table->tinyInteger('id_severidad')->nullable();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedInteger('id_alternativa')->nullable();
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_severidad')->references('id')->on('severidad');
            $table->foreign('id_alternativa')->references('id')->on('alternativa');

            $table->index(['valor', 'id_alternativa', 'id_severidad', 'id_usuario']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ofuscable');
    }
};
