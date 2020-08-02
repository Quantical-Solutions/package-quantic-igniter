<?php

namespace Quantic\Igniter\Workers;

use Quantic\Igniter\Workers\Request;

class Constellation
{
    public static function group($array, $callback)
    {
        if (!empty($array)) {

            if (isset($array['domain']) && $array['domain'] != '') {

                $callback();
            }
        }
    }

    public static function get($uri, $array)
    {
        $type = Request::all();
        if ($type[1] != 'POST' || $type[1] == 'GET') {
            if (!empty($array)) {
                if (isset($array['uses'])) {


                }

                if (isset($array['as'])) {


                }
            }
        }
    }

    public static function post($uri, $array)
    {
        $type = Request::all();
        if ($type[1] == 'POST') {
            if (!empty($array)) {
                if (isset($array['uses'])) {


                }

                if (isset($array['as'])) {


                }
            }
        }
    }
}