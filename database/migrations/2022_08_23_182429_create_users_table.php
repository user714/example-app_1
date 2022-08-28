<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname')->nullable(false);
            $table->string('lastname')->nullable(false);
            $table->string('patronymic')->nullable(false);

            // пришлось вынести в отдельную миграцю (так как таблица phone_number создается после текущей)
            // файл -> 2022_08_23_210436_add_foreign_id_phone_number_to_users_table.php
            //$table->bigInteger('id_phone_number')->unique()->unsigned()->index()->nullable(false);
            //$table->foreign('id_phone_number')->references('id')->on('phone_numbers');

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
        Schema::dropIfExists('users');
    }
}
