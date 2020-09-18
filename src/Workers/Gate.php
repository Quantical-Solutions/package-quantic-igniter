<?php

namespace Quantic\Igniter\Workers;

class Gate
{
    public static array $report = [];

    public static function define($name, $stt)
    {
        self::$report[$name] = $stt;
    }
}