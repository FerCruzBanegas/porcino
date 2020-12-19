<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shed')->unsigned();
            $table->integer('room')->unsigned();
            $table->integer('capacity')->unsigned();
            $table->tinyInteger('state')->default('1');
            $table->integer('phase_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('phase_id')->references('id')->on('phases')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
