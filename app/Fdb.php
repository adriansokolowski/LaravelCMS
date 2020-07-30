<?php

namespace App;

use App\Parser;

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
        $this->url = $url;
        $this->website = $this->website($url);

        // if (empty($this->id())) {
        //     throw new Exception('ERROR');
        // }
    }

    private function search($title)
    {
        $url = $this->website('https://fdb.pl/szukaj?query=' . urlencode($title));
        $url = ($url->find('.media a')) ? $url->find('.media a', 0)->href : null;
        if (!empty($url)) {
            $this->url = $url;
            $this->website = $this->website($this->url);
        } else {
            // throw new Exception('ERROR');
        }
    }

    public function title()
    {
        $title = Parser::getElement($this->website, '[itemprop="name"]', 0, 'plaintext');
        $eTitle = Parser::getElement($this->website, '[itemprop="alternateName"]', 0, 'plaintext');
        if (isset($eTitle)) {
            $title = $title . ' / ' . $eTitle;
        }

        return (isset($title) ? html_entity_decode($title) : null);
    }

    public function year()
    {
        $year = Parser::getElement($this->website, '.nowrap.text-muted a', 0, 'plaintext');

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
        $numItems = count($this->website->find('.list-inline-item.mt-2 a'));
        $category = [];
        foreach ($this->website->find('.list-inline-item.mt-2 a') as $key => $value) {
            if (($key + 1) != $numItems) {
                $category[] = trim(strip_tags($value));
            }
        }

        return (isset($category) ? $category : null);
    }

    public function country()
    {
        $country = Parser::getElement($this->website, '.list-inline-item.mt-2 a', -1, 'plaintext');

        return (isset($country) ? $country : null);
    }

    public function id()
    {
        $id = Parser::getElement($this->website, '[name="movie-id"]', 0, 'content');

        return (isset($id) ? $this->fdb = $id : null);
    }

    public function description()
    {
        $website = $this->website($this->url . '/opisy');
        $description = Parser::getElement($website, '.container .col-md-8 p', 0, 'plaintext');

        return (isset($description) ? preg_replace('@\([^)]+\)@', '', html_entity_decode(htmlspecialchars_decode($description))) : 'Ten film nie ma jeszcze zarysu fabuły.');
    }

    public function json()
    {
        if (!empty($this->title())) {
            return json_encode($this->results());
        }
    }

    public function results()
    {
        if (!empty($this->title())) {
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
}
