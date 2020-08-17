<?php

namespace Quantic\Igniter\Candela;

class Config
{
    /**
     * ConvertEnvConstants method
     * Convert all .env parameters in constants
     *
     * @return array
     */
    public static function ConvertEnvConstants()
    {
        $response = [];
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
                        $response[$constant] = $slice;

                    } else {

                        $response[$constant] = $value;
                    }
                }
            }
        }
        return $response;
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