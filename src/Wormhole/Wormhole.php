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
            $render = $blade->render('debugBar');
        }
        return $render;
    }
}