<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_operators', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger("id_from_operator")->unsigned()->index()->nullable(false);
            $table->foreign('id_from_operator')->references('id')->on('operators');

            $table->bigInteger("id_to_operator")->unsigned()->index()->nullable(false);
            $table->foreign('id_to_operator')->references('id')->on('operators');

            $table->float("price")->nullable(false);


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
        Schema::dropIfExists('price_operators');
    }
}
