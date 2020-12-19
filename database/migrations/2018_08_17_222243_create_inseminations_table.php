<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInseminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inseminations', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->time('time');
            $table->float('dose', 6, 2);
            $table->text('observation')->nullable();
            $table->integer('reproducer_id')->unsigned();
            $table->integer('semen_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('reproducer_id')->references('id')->on('reproducers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('semen_id')->references('id')->on('semen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inseminations');
    }
}
