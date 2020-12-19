<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeaningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weanings', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('quantity')->unsigned();
            $table->decimal('weight', 8, 2);
            $table->decimal('average', 8, 2);
            $table->enum('state', ['PENDING', 'ADMITTED'])->default('PENDING');
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
        Schema::dropIfExists('weanings');
    }
}
