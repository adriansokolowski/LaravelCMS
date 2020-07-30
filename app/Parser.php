<?php

namespace App;

use KubAT\PhpSimple\HtmlDomParser;

class Parser extends HtmlDomParser
{
    public static function getElement(object $DOM, string $theElement, int $position, string $attribute)
    {   
        if ($DOM->find($theElement, $position)){
            return trim(strip_tags($DOM->find($theElement, $position)->{$attribute}));
        }
        return null;
    }
}