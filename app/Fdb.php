<?php

namespace App;

use App\Parser;
use App\Crawler;

class Fdb
{
    public $website, $url;

    public function __construct($string)
    {
        if (filter_var($string, FILTER_VALIDATE_URL) === FALSE) {
            $this->search($string);
        } else {
            $this->url($string);
        }
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
        if (stristr($this->website($url), '<html><body>You are being')){
            $url = Parser::get($this->website($url), 'a', 0, 'href');
            $this->url = $url;
            $this->website = $this->website($url);
        } else {
            $this->url = $url;
            $this->website = $this->website($url);
        }

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

    public function year()
    {
        $year = Parser::get($this->website, '.nowrap.text-muted a');

        return (isset($year) ? filter_var($year, FILTER_SANITIZE_NUMBER_INT) : null);
    }
    
    public function poster()
    { 
        $poster = $this->website->find('.adaptive-image-item', 0)->{'data-srcset'};
        $poster = explode('80w,', $poster);
        $poster = explode('.jpg', $poster[1]);
        $poster = trim($poster[0] . '.jpg');
        
        return (isset($poster) ? $poster : null);
    }

    public function category()
    {
        $category = [];
        $elements = Parser::getAll($this->website, '.list-inline-item.mt-2 a');
        foreach ($elements as $key => $value){
            if ($key !== array_key_last($elements))
                $category[] = $value->plaintext;
        }

        return (isset($category) ? $category : null);
    }

    public function country()
    {
        $country = Parser::get($this->website, '.list-inline-item.mt-2 a', -1, 'plaintext');

        return (isset($country) ? $country : null);
    }

    public function id()
    {
        $id = Parser::get($this->website, '[name="movie-id"]', 0, 'content');

        return (isset($id) ? $this->fdb = $id : null);
    }

    public function description()
    {
        $url = $this->website($this->url . '/opisy');
        $description = trim(Parser::get($url, '.container .col-md-8 p', 0, 'plaintext'));

        return (isset($description) ? preg_replace('@\([^)]+\)@', '', html_entity_decode(htmlspecialchars_decode($description))) : 'Ten film nie ma jeszcze zarysu fabuły.');
    }

    public function json()
    {
        if (!empty($this->title())) {
            return json_encode($this->results());
        }
    }

    public function results(): array
    {
        if (empty($this->title())) {
            return [];
        }
        return array(
            'id' => $this->id(),
            'title' => $this->title(),
            'year' => $this->year(),
            'poster' => $this->poster(),
            'category' => $this->category(),
            'description' => $this->description(),
            'country' => $this->country()
        );
    }
}
