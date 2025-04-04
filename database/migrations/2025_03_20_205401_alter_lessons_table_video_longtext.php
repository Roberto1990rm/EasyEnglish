<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->longText('video')->change(); // Cambia el tipo de dato
        });
    }

    public function down()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('video', 255)->change(); // Revertir si es necesario
        });
    }
};
