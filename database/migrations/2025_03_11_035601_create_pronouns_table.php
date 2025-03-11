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
        Schema::create('pronouns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lecciones')->onDelete('cascade'); // Relación con lecciones
            $table->string('pronoun')->nullable(); // Pronombre asociado
            $table->string('image')->nullable(); // Imagen
            $table->string('video')->nullable(); // Video
            $table->string('audio')->nullable(); // Audio
            $table->text('description')->nullable(); // Descripción
            $table->text('translation')->nullable(); // Traducción
            $table->text('example_1')->nullable(); // Ejemplo 1
            $table->text('example_2')->nullable(); // Ejemplo 2
            $table->timestamps();
        });
    }

    /**
     * Revertir la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('pronouns');
    }
};
