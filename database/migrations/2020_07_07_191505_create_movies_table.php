<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('release_date');
            $table->text('description');
            $table->string('trailer', 15);
            $table->integer('fdb');
            $table->smallInteger('up');
            $table->smallInteger('down');
            $table->integer('view')->default('0');
            $table->integer('slider');
            $table->string('report');
            $table->text('html');
            $table->timestamp('last_view', 0)->nullable();
            $table->float('rate')->default('0');
            $table->smallInteger('visible')->default(1);
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
        Schema::dropIfExists('movies');
        //Storage::deleteDirectory('/poster');
    }
}
