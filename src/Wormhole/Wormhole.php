<?php

namespace Quantic\Igniter\Wormhole;

use Quantic\Igniter\Spectral\ViewsCollector as ViewsCollector;
use Quantic\Igniter\Spectral\ConstellationCollector as ConstellationCollector;
use Carbon\Carbon;
use Jenssegers\Blade\Blade;
use Illuminate\Database\Capsule\Manager as DB;

class Wormhole
{
    public static function BottomBar($state, $ux, $array = [], $exceptions = [])
    {
        $render = '';
        if ($state == 'show') {

            $queries = DB::getQueryLog();

            $viewCollector = new ViewsCollector;
            $activeView = $viewCollector->viewParser($array);

            $constellationCollector =  new ConstellationCollector;
            $activeConstellation = $constellationCollector->constellationParser();

            $renderVars = self::renderVars(
                $activeView,
                $activeConstellation,
                $queries,
                $ux,
                $exceptions
            );

            $blade = new Blade(__DIR__ . '/views', __DIR__ . '/cache');
            $render = $blade->render('debugBar', $renderVars);
        }

        return $render;
    }

    private static function renderVars($activeView, $activeConstellation, $queries, $ux, $exceptions)
    {
        $instant = self::getInstantVars(
            $activeView,
            $activeConstellation
        );

        $data = self::getFakeData();

        $session = [];
        foreach ($_SESSION as $key => $value) {
            if ($key != 'exceptions') {
                $session[$key] = $value;
            }
        }

        $path_info = $_SERVER['REQUEST_URI'];
        $headers_list = headers_list();
        $cookies = $_COOKIE;
        $server = $_SERVER;
        $headers = apache_request_headers();
        $request = $_REQUEST;
        $query = ['get' => $_GET, 'post' => $_POST];
        $code = http_response_code();
        $status_text = ($code == '200') ? 'OK' : 'NOK';
        $status_code = ($code == '200')
            ? '<span class="wormhole-greenCode">' . $code . '</span>'
            : '<span class="wormhole-redCode">' . $code . '</span>';
        $instant['time'] = Carbon::parse($instant['date'], 'UTC')->isoFormat("HH:mm:ss");

        //dump(get_class_methods(DB::class));

        return [
            'data' => $data,
            'instant' => $instant,
            'ux' => $ux,
            'constellation' => $activeConstellation,
            'env' => $_ENV,
            'queries' => $queries,
            'session' => $session,
            'headers_list' => $headers_list,
            'cookies' => $cookies,
            'server' => $server,
            'headers' => $headers,
            'request' => $request,
            'query' => $query,
            'status_text' => $status_text,
            'status_code' => $status_code,
            'path_info' => $path_info,
            'exceptions' => $exceptions,
            'messages' => ''
        ];
    }

    private static function getInstantVars($activeView, $activeConstellation)
    {
        return [
            'id' => 4,
            'date' => date("Y-m-d H:i:s"),
            'method' => 'GET',
            'url' => $_SERVER['REQUEST_URI'],
            'ip' => '176.152.18.54',
            'views' => $activeView,
            'constellation' => $activeConstellation
        ];
    }

    public static function getFakeData()
    {
        return [
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
    }
}