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
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->dateTime('release_date');
            $table->text('description');
            $table->string('trailer', 15)->nullable();
            $table->unsignedInteger('fdb');
            $table->unsignedInteger('up')->default('0');
            $table->unsignedInteger('down')->default('0');
            $table->unsignedInteger('view')->default('0');
            $table->unsignedInteger('slider')->nullable();
            $table->string('report')->nullable();
            $table->text('html')->nullable();
            $table->dateTime('last_view');
            $table->float('imdb_rate')->default('0');
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
        $files = Storage::disk('public')->files('poster');
        Storage::disk('public')->delete($files);
    }
}
