<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('quantity');
            $table->integer('user_id');

            $table->integer('total');
            $table->integer('index');
            $table->integer('phone_number');
            $table->string('address',255);
            $table->string('region',255);
            $table->string('city',255);
            $table->enum('type_of_order',['kaz_mail','pick_up']);
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
        Schema::dropIfExists('orders');
    }
}
