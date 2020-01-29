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

            $table->enum('status',['sent','registered','reject','partner'])->default('sent');
            

            $table->string('name');

            $table->integer('login');
            $table->integer('zhsn',14);
            $table->string('phone',30);
            $table->string('email');
            $table->integer('bill',30);
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
