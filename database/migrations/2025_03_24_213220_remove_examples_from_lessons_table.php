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
    Schema::table('lessons', function (Blueprint $table) {
        $table->dropColumn(['example1', 'example2', 'translation1', 'translation2']);
    });
}

public function down()
{
    Schema::table('lessons', function (Blueprint $table) {
        $table->text('example1')->nullable();
        $table->text('example2')->nullable();
        $table->text('translation1')->nullable();
        $table->text('translation2')->nullable();
    });
}

};
