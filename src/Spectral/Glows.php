<?php

namespace Quantic\Igniter\Spectral;

class Glows
{
    public static function capture($message, $level, $args)
    {
        if (!isset($_ENV['glows'])) {
            $_ENV['glows'] = [];
        }
        if (is_string($message)) {
            if (is_numeric($level)) {
                if (is_array($args) || is_bool($args)) {
                    $compileToArray = ['message' => $message, 'level' => $level, 'arguments' => $args];
                    $go = true;
                    foreach ($_ENV['glows'] as $glow) {
                        if ($compileToArray['message'] == $glow['message']) {
                            $go = false;
                            break;
                        }
                    }
                    if ($go == true) {
                        array_push($_ENV['glows'], $compileToArray);
                        return ['message' => $message, 'level' => $level, 'arguments' => $args];
                    }

                } else {
                    trigger_error('Glows() third param must be an Array or Boolean type');
                }
            } else {
                trigger_error('Glows() second param must be a Numeric type');
            }
        } else {
            trigger_error('Glows() first param must be a String type');
        }
    }
}