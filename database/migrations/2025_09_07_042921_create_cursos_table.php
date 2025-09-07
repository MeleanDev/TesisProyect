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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->boolean('estado')->nullable();
            $table->string('image');
            $table->string('slug')->unique();
            $table->string('nombre')->unique();
            $table->string('descripcion');
            $table->float('precio');
            $table->integer('horasAcademicas');
            $table->integer('maximoParticipantes');
            $table->enum('modalidad', ['online', 'presencial', 'semi-presencial']);
            $table->enum('certificacion', ['si', 'no']);
            $table->enum('tipoCurso', ['computacion', 'administracion', 'diseno']);
            $table->enum('categoria', ['menores', 'ejecutivo', 'empresarial']);
            $table->enum('idioma', ['spanish', 'english']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
