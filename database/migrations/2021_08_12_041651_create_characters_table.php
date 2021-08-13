<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();

            $table->string('name')->index();
            $table->enum('status', ['alive', 'dead'])->index();
            $table->enum('gender', ['male', 'female'])->index();
            $table->enum('race', ['human', 'alien', 'robot', 'humanoid', 'animal'])->index();
            $table->text('description');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
