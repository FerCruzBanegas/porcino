<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReproducersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reproducers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 64);
            $table->enum('origin', ['COMPRA', 'GRANJA']);
            $table->date('arrival')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->date('birth');
            $table->enum('sex', ['HEMBRA', 'MACHO']);
            $table->string('condition', 64);
            $table->string('observation', 128)->nullable();
            $table->integer('genetics_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('genetics_id')->references('id')->on('genetics')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('location_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reproducers');
    }
}
