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
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('correo');
            $table->string('telefono', 20)->nullable();
            $table->enum('asunto', ['cursos-empresas', 'cursos-menores', 'cursos-ejecutivos', 'informacion-general', 'otro']);
            $table->string('mensaje', 255);
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
