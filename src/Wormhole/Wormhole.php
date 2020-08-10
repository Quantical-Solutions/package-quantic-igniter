<?php

namespace Quantic\Igniter\Wormhole;

use Carbon\Carbon;
use Jenssegers\Blade\Blade;

class Wormhole
{
    public static function BottomBar($state, $ux)
    {
        $render = '';
        if ($state == 'show') {

            $data = [
                [
                    'id' => 1,
                    'date' => date("Y-m-d H:i:s"),
                    'method' => 'GET',
                    'url' => $_SERVER['REQUEST_URI'],
                    'ip' => '176.152.18.54'
                ],
                [
                    'id' => 2,
                    'date' => '2020-08-10 09:35:54',
                    'method' => 'POST',
                    'url' => '/admin/voyager-assets?path=images%2Fbg.jpg',
                    'ip' => '176.152.18.54'
                ],
                [
                    'id' => 3,
                    'date' => '2020-08-08 22:25:12',
                    'method' => 'POST',
                    'url' => '/admin/testimonies',
                    'ip' => '94.134.20.12'
                ],
                [
                    'id' => 4,
                    'date' => '2020-08-08 22:25:12',
                    'method' => 'POST',
                    'url' => '/admin/testimonies',
                    'ip' => '94.134.20.12'
                ]
            ];

            $instant = $data[0];
            $instant['time'] = Carbon::parse($instant['date'], 'UTC')->isoFormat("HH:mm:ss");

            $blade = new Blade(__DIR__ . '/views', __DIR__ . '/cache');
            $render = $blade->render('debugBar', ['data' => $data, 'instant' => $instant, 'ux' => $ux]);
        }

        return $render;
    }
}