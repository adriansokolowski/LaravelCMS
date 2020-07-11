<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->unsignedBigInteger('movie_id');
            $table->integer('episode_id');
            $table->string('domain');
            $table->string('file');
            $table->smallInteger('version');
            $table->smallInteger('quality');
            $table->integer('up');
            $table->integer('down');
            $table->integer('view');
            $table->dateTime('last_view');
            $table->smallInteger('visible')->default('1');
            $table->timestamps();

            $table->foreign('movie_id')
                ->references('id')
                ->on('movies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
}
