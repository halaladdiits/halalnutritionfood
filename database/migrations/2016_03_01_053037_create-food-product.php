<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foodproducts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fCode');
            $table->string('fName');
            $table->string('fManufacture');
            $table->integer('fVerify')->default(0);
            $table->integer('fView')->default(0);

            $table->integer('weight')->default(0);
            $table->integer('calories')->default(0);
            $table->float('totalFat')->default(0);
            $table->float('saturatedFat')->default(0);
            $table->float('transFat')->default(0);
            $table->float('cholesterol')->default(0);
            $table->float('sodium')->default(0);
            $table->float('totalCarbohydrates')->default(0);
            $table->float('dietaryFiber')->default(0);
            $table->float('sugar')->default(0);
            $table->float('protein')->default(0);
            $table->integer('vitaminA')->default(0);
            $table->integer('vitaminC')->default(0);
            $table->integer('calcium')->default(0);
            $table->integer('iron')->default(0);

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('foodproducts');
    }
}
