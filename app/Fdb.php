<?php

namespace App;

use App\Parser;
use App\Crawler;
use App\Category;

class Fdb
{
    public $fdb, $website, $url;

    public function __construct($string)
    {
        (filter_var($string, FILTER_VALIDATE_URL) === FALSE)
            ? $this->search($string)
            : $this->url($string);
    }

    private function website($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        return Parser::str_get_html(curl_exec($ch));
    }

    private function url($url)
    {
        if (stristr($this->website($url), '<html><body>You are being')) {
            $url = Parser::get($this->website($url), 'a', 0, 'href');
        }

        $this->url = $url;
        $this->website = $this->website($url);

        // if (empty($this->id())) {
        //     throw new Exception('ERROR');
        // }
    }

    private function search($title)
    {
        $url = $this->website('https://fdb.pl/szukaj?query=' . urlencode($title));
        $url = Parser::get($url, '.media a', 0, 'href');
        if (!empty($url)) {
            $this->url = $url;
            $this->website = $this->website($this->url);
        } else {
            // throw new Exception('ERROR');
        }
    }

    public function title()
    {
        $title = Parser::get($this->website, '[itemprop="name"]');
        $eTitle = trim(Parser::get($this->website, '[itemprop="alternateName"]'));
        $title = $eTitle ? $title . ' / ' . $eTitle : $title;

        return (isset($title) ? html_entity_decode($title) : null);
    }

    public function release_date()
    {
        if ($this->type() == 'movie') {
            return  Parser::get($this->website, '[itemprop="datePublished"]');
        } else {
            return '2011-04-17';
        }
    }

    public function poster()
    {
        $poster = $this->website->find('.adaptive-image-item', 0)->{'data-srcset'};
        $poster = explode('80w,', $poster);
        $poster = explode('.jpg', $poster[1]);
        $poster = trim($poster[0] . '.jpg');

        return $poster ?? null;
    }

    public function categories()
    {
        $categories = [];
        $elements = Parser::getAll($this->website, '.list-inline-item.mt-2 a');
        foreach ($elements as $key => $value) {
            if ($key !== array_key_last($elements))
                $categories[] = $value->plaintext;
        }

        return $categories ?? null;
    }

    public function countries()
    {
        $country = Parser::get($this->website, '.list-inline-item.mt-2 a', -1, 'plaintext');

        $countries = [];
        $countries[] = $country;

        return $countries ?? null;
    }

    public function fdb()
    {
        $id = Parser::get($this->website, '[name="movie-id"]', 0, 'content');

        return (isset($id) ? $this->fdb = $id : null);
    }

    public function type(): string
    {
        return (preg_match('/episodes/', $this->website, $matches))
        ? 'serie'
        : 'movie';
    }

    public function imdb_rate()
    {
        $url = trim(Parser::get($this->website, '#imdb a', 0, 'href') . '/');
        $url = str_replace('http', 'https', $url);
        $imdb_rate = Parser::get($this->website($url), '[itemprop="ratingValue"]', 0, 'innertext');

        return $imdb_rate ?? null;
    }

    public function description()
    {
        $url = $this->website($this->url . '/opisy');
        $description = trim(Parser::get($url, '.container .col-md-8 p', 0, 'plaintext'));

        return (isset($description) ? preg_replace('@\([^)]+\)@', '', html_entity_decode(htmlspecialchars_decode($description))) : 'Ten film nie ma jeszcze zarysu fabuły.');
    }

    public function direction()
    {
        $elements = Parser::getAll($this->website, '[itemprop="director"] span');
        $direction = [];
        foreach ($elements as $key => $value) :
            $direction[] = $value->plaintext;
        endforeach;

        return $direction ?? null;
    }

    public function screenplay()
    {
        $elements = Parser::getAll($this->website, '[itemprop="author"] span');
        $screenplay = [];
        foreach ($elements as $key => $value) :
            $screenplay[] = $value->plaintext;
        endforeach;

        return $screenplay ?? null;
    }

    public function cast()
    {
        $url = $this->website($this->url . '/obsada');
        $elements = Parser::getAll($url, '.toggle-actors .adaptive-image.width-50');
        $cast = [];
        foreach ($elements as $key => $value) :
            $cast[] = $value
                ->parent()
                ->parent()
                ->next_sibling()
                ->first_child()
                ->plaintext;
        endforeach;

        return $cast ?? null;
    }

    public function results(): array
    {
        if (empty($this->title())) {
            return [];
        }
        return [
            'title' => $this->title(),
            'release_date' => $this->release_date(),
            'poster' => $this->poster(),
            'categories' => $this->categories(),
            'description' => $this->description(),
            'fdb' => $this->fdb(),
            'imdb_rate' => $this->imdb_rate(),
            'direction' => $this->direction(),
            'countries' => $this->countries(),
            'screenplay' => $this->screenplay(),
            'cast' => $this->cast(),
            'type' => $this->type()
        ];
    }
}
