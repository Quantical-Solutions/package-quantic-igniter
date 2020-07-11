<?php

namespace Quantic\Igniter\Config;

class EnvConfig
{
    public static function ConvertEnvConstants()
    {
        if (file_exists(ROOTDIR . '/.env')) {

            $env_file = file_get_contents(ROOTDIR . '/.env');

            if (strpos($env_file, '=') !== false) {

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
    }
}