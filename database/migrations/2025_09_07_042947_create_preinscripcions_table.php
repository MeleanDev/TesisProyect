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
        Schema::create('preinscripcions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_registrado_id')->nullable()->constrained('cliente_registrados')->onDelete('set null');
            $table->foreignId('curso_id')->nullable()->constrained('cursos')->onDelete('set null');
            $table->enum('estado', ['Pendiente', 'Aceptado', 'Negado', 'Graduado']);
            $table->string('comentario')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preinscripcions');
    }
};
