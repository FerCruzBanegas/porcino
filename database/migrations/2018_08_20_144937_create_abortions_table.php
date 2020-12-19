<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbortionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abortions', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('reason', 64);
            $table->text('observation')->nullable();
            $table->integer('reproducer_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('reproducer_id')->references('id')->on('reproducers')
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
        Schema::dropIfExists('abortions');
    }
}
