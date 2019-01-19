<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cCode');
            $table->date('cExpire');
            $table->integer('cStatus');
            $table->string('cOrganization');
            $table->timestamps();
        });

        Schema::create('foodproduct_certificate', function(Blueprint $table)
        {
            $table->integer('foodproduct_id')->unsigned()->index();
            $table->foreign('foodproduct_id')->references('id')->on('foodproducts')->onDelete('cascade');

            $table->integer('certificate_id')->unsigned()->index();
            $table->foreign('certificate_id')->references('id')->on('certificates')->onDelete('cascade');

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
        Schema::dropIfExists('foodproduct_certificate');
        Schema::dropIfExists('certificates');
    }
}
