<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Ejecutar la migración.
     */
    public function up(): void
    {
        Schema::create('lecciones', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Título de la lección
            $table->text('description'); // Descripción de la lección
            $table->string('image')->nullable(); // Imagen de la lección
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Revertir la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecciones');
    }
};
