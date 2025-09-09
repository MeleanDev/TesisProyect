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
        Schema::create('cliente_registrados', function (Blueprint $table) {
            $table->id();
            $table->boolean('estado')->nullable();
            $table->string('Pnombre', 100);
            $table->string('Snombre', 100)->nullable();
            $table->string('Papelldio', 100);
            $table->string('Sapelldio', 100)->nullable();
            $table->string('identidad', 20)->unique();
            $table->string('email', 100);
            $table->string('telefono', 20);
            $table->string('image')->nullable();
            $table->date('fecha_nacimiento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_registrados');
    }
};
