<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iName');
            $table->integer('iType')->default(0);
            $table->string('eNumber')->nullable();
            $table->timestamps();
        });

        Schema::create('foodproduct_ingredient', function(Blueprint $table)
        {
            $table->integer('foodproduct_id')->unsigned()->index();
            $table->foreign('foodproduct_id')->references('id')->on('foodproducts')->onDelete('cascade');

            $table->integer('ingredient_id')->unsigned()->index();
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');

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
        Schema::dropIfExists('foodproduct_ingredient');
        Schema::dropIfExists('ingredients');
    }
}
