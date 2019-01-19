<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHalalSources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halalsources', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('hStatus');
            $table->text('hDescription');
            $table->string('hOrganization');
            $table->text('hUrl')->nullable();
            $table->timestamps();
        });

        Schema::create('ingredient_halal', function(Blueprint $table)
        {
            $table->integer('ingredient_id')->unsigned()->index();
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');

            $table->integer('halal_id')->unsigned()->index();
            $table->foreign('halal_id')->references('id')->on('halalsources')->onDelete('cascade');

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
        Schema::dropIfExists('ingredient_halal');
        Schema::dropIfExists('halalsources');
    }
}
