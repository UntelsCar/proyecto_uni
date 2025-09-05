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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id('estudiante_id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->integer('edad');
            $table->date('fecha_nacimiento');
            $table->string('dni')->unique();
            $table->string('email')->unique();
            $table->string('foto')->nullable();
            $table->string('codigo')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
