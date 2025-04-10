<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('exercise_results', function (Blueprint $table) {
            $table->boolean('pronoun')->default(0)->after('correct');
        });
    }
    
    public function down()
    {
        Schema::table('exercise_results', function (Blueprint $table) {
            $table->dropColumn('pronoun');
        });
    }
    
};
