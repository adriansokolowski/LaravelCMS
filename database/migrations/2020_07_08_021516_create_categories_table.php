<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        $categories = [
            ['name' => 'Akcja'],
            ['name' => 'Animowany'],
            ['name' => 'Biograficzny'],
            ['name' => 'Dla dorosłych'],
            ['name' => 'Dokumentalny'],
            ['name' => 'Dramat'],
            ['name' => 'Erotyczny'],
            ['name' => 'Etiuda'],
            ['name' => 'Familijny'],
            ['name' => 'Fantasy'],
            ['name' => 'Film-Noir'],
            ['name' => 'Historyczny'],
            ['name' => 'Horror'],
            ['name' => 'Komedia'],
            ['name' => 'Kostiumowy'],
            ['name' => 'Krótkometrażowy'],
            ['name' => 'Kryminał'],
            ['name' => 'Musical'],
            ['name' => 'Muzyczny'],
            ['name' => 'Niemy'],
            ['name' => 'Obyczajowy'],
            ['name' => 'Paradokument'],
            ['name' => 'Przygodowy'],
            ['name' => 'Romans'],
            ['name' => 'Sci-Fi'],
            ['name' => 'Sportowy'],
            ['name' => 'Sztuki walki'],
            ['name' => 'Thriller'],
            ['name' => 'Western'],
            ['name' => 'Wojenny']
          ];
          
          DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
