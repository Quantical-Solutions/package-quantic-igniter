<?php

namespace Quantic\Igniter\Wormhole;

use Quantic\Igniter\Spectral\ViewsCollector as ViewsCollector;
use Quantic\Igniter\Spectral\ConstellationCollector as ConstellationCollector;
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
    public static function BottomBar($state, $ux, $array = [])
    {
        $render = '';
        if ($state == 'show') {

            $viewCollector = new ViewsCollector;
            $activeView = $viewCollector->viewParser($array);

            //dump($activeView);

            $constellationCollector =  new ConstellationCollector;
            $activeConstellation = $constellationCollector->constellationParser();

            //dump($activeConstellation);

            $instant = [
                'id' => 4,
                'date' => date("Y-m-d H:i:s"),
                'method' => 'GET',
                'url' => $_SERVER['REQUEST_URI'],
                'ip' => '176.152.18.54',
                'views' => $activeView,
                'constellation' => ''
            ];

            $data = [
                [
                    'id' => 3,
                    'date' => '2020-08-10 09:35:54',
                    'method' => 'POST',
                    'url' => '/admin/voyager-assets?path=images%2Fbg.jpg',
                    'ip' => '176.152.18.54'
                ],
                [
                    'id' => 2,
                    'date' => '2020-08-08 22:25:12',
                    'method' => 'POST',
                    'url' => '/admin/testimonies',
                    'ip' => '94.134.20.12'
                ],
                [
                    'id' => 1,
                    'date' => '2020-08-08 22:25:12',
                    'method' => 'POST',
                    'url' => '/admin/testimonies',
                    'ip' => '94.134.20.12'
                ]
            ];

            $instant['time'] = Carbon::parse($instant['date'], 'UTC')->isoFormat("HH:mm:ss");

            $blade = new Blade(__DIR__ . '/views', __DIR__ . '/cache');
            $render = $blade->render('debugBar', [
                'data' => $data,
                'instant' => $instant,
                'ux' => $ux,
                'constellation' => $activeConstellation
            ]);
        }

        return $render;
    }
}