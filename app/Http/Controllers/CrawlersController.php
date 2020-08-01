<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use KubAT\PhpSimple\HtmlDomParser;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use App\Fdb;


class CrawlersController extends Controller
{
    public function index()
    {
        return view('crawlers.index');
    }

    public function add()
    {
        dd($fdb = (new Fdb('Truman Show / The Truman Show'))->json());
        $this->fdb();
    }

    private function fdb()
    {
        set_time_limit(0);

        // https://fdb.pl/film/955436-w-poszukiwaniu-zlotego-zamku

        for ($i = request()->from; $i < request()->to; $i++) {
            $fdb = (new Fdb('https://fdb.pl/film/'.$i));

            DB::table('movies')->insert([
                'title' => $fdb->title(),
                'desc' => $fdb->description(),
                'year' => 2000,
                'fdb' => $i,
                'rate' => 11,
                'view' => rand(1000, 100000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $movie_id = DB::getPdo()->lastInsertId();
            $contents = file_get_contents($fdb->poster());
            Storage::disk("public")->put('/poster/' . $movie_id . '.jpg', $contents);

            foreach ($fdb->category() as $category) {
                $cat = DB::table('categories')->where('name', $category)->first();
                DB::table('category_movie')->insert([
                    'movie_id' => $movie_id,
                    'category_id' => $cat->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        return view('movies.index');
            // if (!$html->find('.well', 0)) {
            //     if (preg_match('/episodes/', $html, $matches)) {
            //         DB::table('series')->insert([
            //             'title' => $name,
            //             'desc' => $desc,
            //             'year' => '9999',
            //             'fdb' => $fdb,
            //             'rate' => $rate,
            //             'created_at' => now(),
            //             'updated_at' => now()
            //         ]);
            //         $serie_id = DB::getPdo()->lastInsertId();
            //         $contents = file_get_contents($img);
            //         Storage::disk("public")->put('/poster/' . $serie_id . '-s.jpg', $contents);
            //     } else {
            //         DB::table('movies')->insert([
            //             'title' => $name,
            //             'desc' => $desc,
            //             'year' => $year,
            //             'fdb' => $fdb,
            //             'rate' => $rate,
            //             'view' => rand(1000, 100000),
            //             'created_at' => now(),
            //             'updated_at' => now(),
            //         ]);

            //         


            //     }
            // }
    }
}
