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
            $table->tinyInteger('clasificacion')->nullable();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedInteger('id_alternativa')->nullable();
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('clasificacion')->references('id')->on('clasificacion');
            $table->foreign('id_alternativa')->references('id')->on('alternativa');
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
