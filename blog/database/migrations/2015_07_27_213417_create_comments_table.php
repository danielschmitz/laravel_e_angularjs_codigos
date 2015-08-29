<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->string('email')->nullable();
            $table->boolean('active')->default(false);
            $table->timestamps();
            $table->integer('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts') ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
