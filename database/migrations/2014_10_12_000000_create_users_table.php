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
            $table->increments('id');
            $table->string('name')->index();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('age')->unsigned()->default(0);
            $table->boolean('gender')->default(true);
            $table->integer('province_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('occupation_id')->nullable();
            $table->integer('follower_count')->default(0)->unsigned();
            $table->integer('following_count')->default(0)->unsigned();
            $table->integer('work_count')->default(0)->unsigned();
            $table->integer('tutorial_count')->default(0)->unsigned();
            $table->rememberToken();
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
