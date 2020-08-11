<?php

namespace Quantic\Igniter\Wormhole;

use namespace Quantic\Igniter\Spectral\ViewsCollector;

use Carbon\Carbon;
use Jenssegers\Blade\Blade;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\ContextProvider\CliContextProvider;
use Symfony\Component\VarDumper\Dumper\ContextProvider\SourceContextProvider;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use Symfony\Component\VarDumper\Dumper\ServerDumper;
use Symfony\Component\VarDumper\VarDumper;

class Wormhole
{
    protected $allViews;

    public static function BottomBar($state, $ux, $array = [])
    {
        $render = '';
        if ($state == 'show') {

            $analyse = ViewsCollector::viewParser($array);
            $wormhole = new self;
            $wormhole->allViews = $analyse;
            dump($wormhole->allViews);

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