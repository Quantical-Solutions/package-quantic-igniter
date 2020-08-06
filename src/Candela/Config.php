<?php

namespace Quantic\Igniter\Candela;

class Config
{
    /**
     * ConvertEnvConstants method
     * Convert all .env parameters in constants
     *
     * @return void
     */
    public static function ConvertEnvConstants()
    {
        if (file_exists(ROOTDIR . '/.init')
            && strpos(file_get_contents(ROOTDIR . '/.init'), '=') !== false) {

            $env_file = file_get_contents(ROOTDIR . '/.init');
            $lines = explode("\n", $env_file);

            foreach ($lines as $line) {

                if (strpos($line, '=') !== false) {

                    $constant = trim(explode('=', $line)[0]);
                    $value = trim(explode('=', $line)[1]);

                    if (strpos($value, '"${') === 0
                        && strpos($value, '}"') === strlen($value) - 2) {

                        $length = strlen($value) - 5;
                        $slice = substr($value, 3, $length);
                        $variable = constant($slice);
                        define($constant, $variable);

                    } else {

                        define($constant, $value);
                    }
                }
            }
        }
    }

    /**
     * uriSegments method
     * Convert REQUEST_URI in array.
     *
     * @return array
     */
    public static function uriSegments()
    {
        $uris = $_SERVER['REQUEST_URI'];
        $explode = explode('/', $uris);
        return $explode;
    }
}