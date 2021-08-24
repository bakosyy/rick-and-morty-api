<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBirthLocationAndCurrentLocationColumnsToCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->unsignedBigInteger('birth_location_id')->nullable()->after('description');
            $table->unsignedBigInteger('current_location_id')->nullable()->after('birth_location_id');

            $table->foreign('birth_location_id')->references('id')->on('locations')->restrictOnDelete();
            $table->foreign('current_location_id')->references('id')->on('locations')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn(['birth_location_id', 'current_location_id']);
        });
    }
}
