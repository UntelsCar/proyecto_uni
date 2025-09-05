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
        Schema::create('registro_estacionamientos', function (Blueprint $table) {
            $table->id('rgEst_id');
            $table->timestamp('fecha_ingreso');
            $table->timestamp('fecha_salida')->nullable();
            $table->string('placa_vehiculo')->nullable();
            $table->string('tipo_vehiculo');
            $table->string('descripcion_vehiculo');
            $table->string('foto_vehiculo');
            $table->string('estado');

            //Foreign keys
            $table->unsignedBigInteger('estudiante_id');

            //Constraints
            $table->foreign('estudiante_id')->references('estudiante_id')->on('estudiantes');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_estacionamiento');
    }
};
