<?php

namespace Quantic\Igniter\Workers;

use Quantic\Igniter\Workers\Request;

class Constellation
{
    public static function group($array, $callback)
    {

    }

    public static function get($uri, $array)
    {
        $type = Request::all();
        if ($type[1] != 'POST' || $type[1] == 'GET') {

        }
    }

    public static function post($uri, $array)
    {
        $type = Request::all();
        if ($type[1] == 'POST') {

        }
    }
}