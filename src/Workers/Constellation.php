<?php

namespace Quantic\Igniter\Workers;

use Quantic\Igniter\Workers\Request;

class Constellation
{
    public static function group($array, $callback)
    {
        $domain = self::checkDomain();

        if (!empty($array)) {

            if (isset($array['domain']) && $array['domain'] == $domain) {

                $callback();
            }
        }
    }

    public static function get($uri, $array)
    {
        if (!defined('VIEWINIT')) {

            $url = self::analyseUri($uri);

            if ($url != false) {

                $segments = $url[0];
                $options = $url[1];

                $type = Request::all();

                if ($_SERVER['REQUEST_METHOD'] === 'GET') {

                    $_ENV['constellation'] = [
                        'request_string' => '/' . $segments,
                        'request_type' => $_SERVER['REQUEST_METHOD'],
                        'request_url' => $_SERVER['REQUEST_URI']
                    ];

                    self::splitString($array, $options);
                }
            }
        }
    }

    public static function post($uri, $array)
    {
        if (!defined('VIEWINIT')) {

            $url = self::analyseUri($uri);

            if ($url != false) {

                $segments = $url[0];
                $options = $url[1];

                $type = Request::all();

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $_ENV['constellation'] = [
                        'request_string' => '/' . $segments,
                        'request_type' => $_SERVER['REQUEST_METHOD'],
                        'request_url' => $_SERVER['REQUEST_URI']
                    ];

                    self::splitString($array, $options);
                }
            }
        }
    }

    public static function put($uri, $array)
    {
        if (!defined('VIEWINIT')) {

            $url = self::analyseUri($uri);

            if ($url != false) {

                $segments = $url[0];
                $options = $url[1];

                if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

                    $_ENV['constellation'] = [
                        'request_string' => '/' . $segments,
                        'request_type' => $_SERVER['REQUEST_METHOD'],
                        'request_url' => $_SERVER['REQUEST_URI']
                    ];

                    self::splitString($array, $options);
                }
            }
        }
    }

    public static function delete($uri, $array)
    {
        if (!defined('VIEWINIT')) {

            $url = self::analyseUri($uri);

            if ($url != false) {

                $segments = $url[0];
                $options = $url[1];

                if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

                    $_ENV['constellation'] = [
                        'request_string' => '/' . $segments,
                        'request_type' => $_SERVER['REQUEST_METHOD'],
                        'request_url' => $_SERVER['REQUEST_URI']
                    ];

                    self::splitString($array, $options);
                }
            }
        }
    }

    private static function cleanRequest_uri()
    {
        $clean = substr($_SERVER['REQUEST_URI'], 1);
        $clean = (substr($clean, -1) != '/') ? $clean : substr($clean, 0, strlen($clean)-1);
        $explode = explode('/', $clean);
        return $explode;
    }

    private static function execute($class, $method, $options)
    {
        define('VIEWINIT', true);
        $controller = 'App\\Http\\Controllers\\' . $class;

        if (class_exists($controller) && method_exists($controller, $method)) {

            $exec = new $controller;

            if (empty($options)) {

                $exec->$method();

            } else {

                call_user_func_array(array($exec, $method), $options);
            }
        }
    }

    private static function analyseUri($uri)
    {
        $response = false;
        $cnt = 0;

        $options = [];
        $originalSegmentsArray = self::cleanRequest_uri();
        $originalSegmentsNumber = count($originalSegmentsArray);

        $url = (substr($uri, 0, 1) != '/') ? $uri : substr($uri, 1);
        $url = (substr($url, -1) != '/') ? $url : substr($url, 0, strlen($url)-1);
        $explode = explode('/', $url);
        $urlCount = count($explode);

        if ($originalSegmentsArray[0] != '' && $originalSegmentsNumber == $urlCount) {

            $open = '{';
            $close = '}';

            foreach ($explode as $segment) {

                $lastIndex = strlen($segment) - 1;
                $firstChar = ($lastIndex >= 0) ? $segment[0] : '';
                $lastChar = ($lastIndex >= 0) ? $segment[$lastIndex] : '';

                if ($firstChar == $open && $lastChar == $close) {

                    $control = substr($segment, 1, $lastIndex - 1);
                    $var = $originalSegmentsArray[$cnt];
                    array_push($options, $var);
                    $cnt++;

                } else if ($originalSegmentsArray[$cnt] == $explode[$cnt]) {

                    $cnt++;
                }
            }
        }

        if ($cnt == $originalSegmentsNumber || $originalSegmentsArray[0] == '') {

            $response = array($url, $options);
        }

        return $response;
    }

    private static function splitString($array, $options)
    {
        $class= false;
        $method = false;

        if (!empty($array)) {

            if (isset($array['uses'])) {

                $uses = $array['uses'];
                $explode = explode('@', $uses);
                $class = (isset($explode[0])) ? $explode[0] : false;
                $method = (isset($explode[1])) ? $explode[1] : false;
            }

            if (isset($array['as']) && $array['as'] != '') {

                $as = $array['as'];
            }
        }

        if ($class != false && $method != false) {

            self::execute($class, $method, $options);
        }
    }

    private static function checkDomain()
    {
        $protocol = ($_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
        $domain = $protocol . $_SERVER['SERVER_NAME'];
        return $domain;
    }

    public function where($var)
    {
        var_dump($var);
    }
}