<?php

namespace Quantic\Igniter\Spectral;

use ErrorException;

class Context
{
    public static function capture($name, $string)
    {
        if (!isset($_ENV['contexts'])) {
            $_ENV['contexts'] = [];
        }
        if (is_string($name)) {
            if (is_string($string)) {
                $go = true;
                foreach ($_ENV['contexts'] as $key => $context) {
                    if ($key == $name) {
                        $go = false;
                    }
                }
                if ($go == true) {
                    $_ENV['contexts'][$name] = $string;
                    return ['name' => $name, 'infos' => $string];
                }

            } else {
                trigger_error('Context() second param must be a String type');
            }
        } else {
            trigger_error('Context() first param must be a String type');
        }
    }

    public static function group($name, $array)
    {
        if (!isset($_ENV['contexts'])) {
            $_ENV['contexts'] = [];
        }
        if (is_string($name)) {
            if (is_array($array)) {
                $go = true;
                foreach ($_ENV['contexts'] as $key => $context) {
                    if ($key == $name) {
                        $go = false;
                    }
                }
                if ($go == true) {
                    $_ENV['contexts'][$name] = $array;
                    return ['name' => $name, 'infos' => $array];
                }

            } else {
                trigger_error('ContextGroup() second param must be an Array type');
            }
        } else {
            trigger_error('ContextGroup() first param must be a String type');
        }
    }
}