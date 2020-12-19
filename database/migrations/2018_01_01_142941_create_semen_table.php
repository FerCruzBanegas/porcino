<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 64);
            $table->integer('genetics_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('genetics_id')->references('id')->on('genetics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semen');
    }
}
