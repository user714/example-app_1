<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_calls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("id_from_user")->unsigned()->index()->nullable(false);
            $table->foreign('id_from_user')->references('id')->on('users');

            $table->bigInteger("id_to_user")->unsigned()->index()->nullable(false);
            $table->foreign('id_to_user')->references('id')->on('users');

            $table->bigInteger("id_from_phone")->unsigned()->index()->nullable(false);
            $table->foreign('id_from_phone')->references('id')->on('phone_numbers');


            $table->bigInteger("id_to_phone")->unsigned()->index()->nullable(false);
            $table->foreign('id_to_phone')->references('id')->on('phone_numbers');

            $table->integer("start_call")->nullable(false);
            $table->integer("finish_call")->nullable(false);
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
        Schema::dropIfExists('history_calls');
    }
}
