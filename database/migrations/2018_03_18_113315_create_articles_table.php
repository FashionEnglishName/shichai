<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->text('content');
            $table->text('cover')->nullable();
            $table->integer('user_id')->index();
            $table->integer('category_id')->unsigned();
            $table->integer('last_reply_user_id')->unsigned()->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->timestamp('assigned_at')->nullable();
            $table->integer('reply_count')->unsigned()->default(0);
            $table->integer('view_count')->unsigned()->default(0);
            $table->integer('firewood_count')->unsigned()->default(0);
            $table->integer('collection_count')->unsigned()->default(0);
            $table->boolean('work_or_tutorial')->default(false);
            $table->boolean('has_tutorial')->default(false);
            $table->boolean('is_assigned')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
