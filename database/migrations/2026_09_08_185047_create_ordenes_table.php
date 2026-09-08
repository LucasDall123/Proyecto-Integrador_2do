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
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained()->onDelete('cascade');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->string('codigo')->unique(); // unique tracking code e.g., TRK-98231X
            $table->text('falla_reportada');
            $table->text('diagnostico_tecnico')->nullable();
            $table->enum('estado', ['Ingresado', 'En Diagnóstico', 'Esperando Repuesto', 'Listo p/ Retirar'])->default('Ingresado');
            $table->date('fecha_ingreso');
            $table->date('fecha_entrega')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};
