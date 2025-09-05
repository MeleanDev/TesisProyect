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
        Schema::create('seccion_cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->require();
            $table->string('apellido')->require();
            $table->string('correo')->require();
            $table->string('telefono')->nullable();
            $table->enum('asunto', ['cursos-empresas', 'cursos-menores', 'cursos-ejecutivos', 'informacion-general', 'otro']);
            $table->string('mensaje')->require();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seccion_cursos');
    }
};
