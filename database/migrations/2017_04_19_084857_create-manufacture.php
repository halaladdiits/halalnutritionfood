<?php

/**
* Created by Adnan Mauludin Fajriyadi
* "Peningkatan Relevansi Pencarian Produk Halal Dalam Aplikasi Halal Nutrition Food Menggunakan Algoritma OKAPI BM25F"
*
* April 2017
*/

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManufacture extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufactures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('foodproduct_manufacture', function(Blueprint $table)
        {
            $table->integer('foodproduct_id')->unsigned()->index();
            $table->foreign('foodproduct_id')->references('id')->on('foodproducts')->onDelete('cascade');

            $table->integer('manufacture_id')->unsigned()->index();
            $table->foreign('manufacture_id')->references('id')->on('manufactures')->onDelete('cascade');

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
        Schema::dropIfExists('foodproduct_manufacture');
        Schema::dropIfExists('manufactures');
    }
}
