<?php

namespace Quantic\Igniter\Spectral;

use ErrorException;

class Context
{
    public static function capture($name, $string)
    {
        if (is_string($name)) {
            if (is_string($string)) {
                $_ENV['contexts']['name'] = $string;
                return ['name' => $name, 'infos' => $string];
            } else {
                trigger_error('Context() second param must be a String type');
            }
        } else {
            trigger_error('Context() first param must be a String type');
        }
    }

    public static function group($name, $array)
    {
        if (is_string($name)) {
            if (is_array($array)) {
                $_ENV['contexts']['name'] = $array;
                return ['name' => $name, 'infos' => $array];
            } else {
                trigger_error('ContextGroup() second param must be an Array type');
            }
        } else {
            trigger_error('ContextGroup() first param must be a String type');
        }
    }
}