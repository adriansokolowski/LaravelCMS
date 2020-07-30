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
        $fdb = new Fdb('https://fdb.pl/film/955436-w-poszukiwaniu-zlotego-zamku');
        // https://fdb.pl/film/955436-w-poszukiwaniu-zlotego-zamku
        dd($fdb->results());
    }

    private function fdb()
    {
        set_time_limit(5000);

        //error_reporting(0);
        //$allcategories = DB::table('categories')->get();

        for ($i = request()->from; $i < request()->to; $i++) {
            $url = 'https://fdb.pl/film/' . $i;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_HEADER, false); 
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_REFERER, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
            $str = curl_exec($curl);
            curl_close($curl);
            $html = HtmlDomParser::str_get_html($str);
            if (!$html->find('.well', 0)) {

                $img = $html->find('.adaptive-image-item', 0)->{'data-srcset'};
                $img = explode('80w,', $img);
                $img = explode('.jpg', $img[1]);
                $img = trim($img[0] . '.jpg');
                $fdb = $html->find('[name="movie-id"]', 0)->{'content'};
                $name = trim($html->find('[itemprop="name"]', 0)->plaintext);
                if ($html->find('[itemprop="alternateName"]', 0)) {
                    $oname = trim($html->find('[itemprop="alternateName"]', 0)->plaintext);
                    $name = $name . ' / ' . $oname;
                }
                $year = $html->find('.nowrap.text-muted a', 0)->plaintext;
                $rate = trim($html->find('[itemprop="ratingValue"]', 0)->plaintext);
                $rate = str_replace(',', '.', $rate);
                if (stristr($year, '-') || stristr($year, '/')) {
                    $year = '1000';
                }
                $numItems = count($html->find('.list-inline-item.mt-2 a'));
                $categories = [];
                foreach ($html->find('.list-inline-item.mt-2 a') as $key => $item) {
                    if (($key + 1) != $numItems) {
                        $categories[] = trim(strip_tags($item));
                    } else {
                        echo 'country: ' . $item->innertext . '<br>';
                    }
                }
                if ($html->find('span[itemprop="description"]', 0)) {
                    $desc = trim($html->find('span[itemprop="description"]', 0)->plaintext);
                } else {
                    $desc = '';
                }
                if (preg_match('/episodes/', $html, $matches)) {
                    DB::table('series')->insert([
                        'title' => $name,
                        'desc' => $desc,
                        'year' => '9999',
                        'fdb' => $fdb,
                        'rate' => $rate,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    $serie_id = DB::getPdo()->lastInsertId();
                    $contents = file_get_contents($img);
                    Storage::disk("public")->put('/poster/' . $serie_id . '-s.jpg', $contents);
                } else {
                    DB::table('movies')->insert([
                        'title' => $name,
                        'desc' => $desc,
                        'year' => $year,
                        'fdb' => $fdb,
                        'rate' => $rate,
                        'view' => rand(1000, 100000),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $movie_id = DB::getPdo()->lastInsertId();
                    $contents = file_get_contents($img);
                    Storage::disk("public")->put('/poster/' . $movie_id . '.jpg', $contents);

                    foreach ($categories as $category) {
                        $cat = DB::table('categories')->where('name', $category)->first();
                        DB::table('category_movie')->insert([
                            'movie_id' => $movie_id,
                            'category_id' => $cat->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}
