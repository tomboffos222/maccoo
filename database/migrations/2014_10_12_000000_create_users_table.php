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
            $table->integer('bs_id');

            $table->enum('status',['sent','registered','reject'])->default('sent');
            $table->enum('prize',['home','car','tech']);

            $table->string('name');
            $table->string('login');
            $table->string('phone',30);
            $table->string('email');
            $table->string('password')->nullable();

            $table->integer('bot_owner_id')->nullable()->default(null);

            $table->timestamps();
            $table->softDeletes();
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
