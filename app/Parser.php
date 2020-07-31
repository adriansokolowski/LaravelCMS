<?php

namespace App;

use KubAT\PhpSimple\HtmlDomParser;

class Parser extends HtmlDomParser
{
    public static function get(object $DOM, string $selector, int $index = 0, string $property = 'innertext')
    {   
        return $DOM->find($selector, $index)->{$property} ?? null;
    }

    public static function getAll(object $DOM, string $selector)
    {
        return $DOM->find($selector) ?? null;
    }
}