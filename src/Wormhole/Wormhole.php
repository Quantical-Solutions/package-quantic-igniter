<?php

namespace Quantic\Igniter\Wormhole;

use Carbon\Carbon;
use Jenssegers\Blade\Blade;

class Wormhole
{
    public static function BottomBar($state)
    {
        $render = '';
        if ($state == 'show') {

            $blade = new Blade(__DIR__ . '/views', __DIR__ . '/cache');
            $render = $blade->render('bottomBar');
        }
        return $render;
    }

    public static function StandAlone($state, $method)
    {
        $render = '';
        if ($state == 'show') {

            $blade = new Blade(__DIR__ . '/views', __DIR__ . '/cache');
            $render = $blade->render('standAlone', ['debugMethod' => $method]);
        }
        return $render;
    }
}