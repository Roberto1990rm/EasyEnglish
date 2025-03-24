<?php

// database/migrations/xxxx_xx_xx_create_examples_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamplesTable extends Migration
{
    public function up()
    {
        Schema::create('examples', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->text('example')->nullable();;
            $table->text('translation')->nullable();;
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('examples');
    }
}
