<?php

namespace Quantic\Igniter\Workers;

use Quantic\Igniter\Workers\Request;
use ReflectionClass;
use Quantic\Chosen\Matrix\Auth;

class Constellation
{
    protected array $page;

    public function __construct($nav)
    {
        $chosen = (class_exists(Auth::class)) ? Auth::addLinks() : [];
        $extra = require_once __DIR__ . '/DeclaredLinks.php';
        foreach ($extra as $key => $ex) {
            $nav[$key] = $ex;
        }
        foreach ($chosen as $key => $ch) {
            $nav[$key] = $ch;
        }
        $this->parseNavigation($nav);
    }

    private function parseNavigation($pages)
    {
        $cnt = 0;
        $response = false;
        foreach ($pages as $page) {

            if ($this->group($page)) {
                $requestType = strtoupper($page['request']);
                $response = $this->requestType($page, $requestType);
                if (is_string($response)) {
                    echo $response;
                }
            }
        }
    }

    private function requestType($page, $requestType)
    {
        if (!defined('VIEWINIT')) {

            $url = $this->analyseUri($page['uri']);

            if ($url != false) {

                $segments = $url[0];
                $options = $url[1];
                $controls = $url[2];
                $this->where($controls, $page);

                $type = Request::all();

                $this->page = [
                    'request_string' => '/' . $segments,
                    'request_type' => ($_SERVER['REQUEST_METHOD'] == $requestType) ? $requestType : $_SERVER['REQUEST_METHOD'],
                    'request_url' => $_SERVER['REQUEST_URI']
                ];

                $this->splitString($page, $options);
            }
        }
    }

    private function group($page)
    {
        $response = true;
        $protocol = ($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $actualDomain = $protocol . $_SERVER['SERVER_NAME'];

        if (isset($page['group'])) {

            if ($page['group'] == $actualDomain) {
                $response = true;
            } else {
                $response = false;
            }
        }

        return $response;
    }

    private function analyseUri($uri)
    {
        $response = false;
        $cnt = 0;

        $controls = [];
        $options = [];
        $originalSegmentsArray = $this->cleanRequest_uri();
        $originalSegmentsNumber = count($originalSegmentsArray);

        $url = (substr($uri, 0, 1) != '/') ? $uri : substr($uri, 1);
        $url = (substr($url, -1) != '/') ? $url : substr($url, 0, strlen($url)-1);
        $explode = explode('/', $url);
        $segmentCounter = $this->segmentCounter($explode);
        $urlCount = count($explode);

        if ($segmentCounter) {

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
                        $controls[$control] = $var;
                        $cnt++;

                    } else if ($originalSegmentsArray[$cnt] == $explode[$cnt]) {

                        $cnt++;
                    }
                }
            }

            if ($cnt == $originalSegmentsNumber || $originalSegmentsArray[0] == '') {

                $response = array($url, $options, $controls);
            }
        }

        return $response;
    }

    private function cleanRequest_uri()
    {
        $clean = substr($_SERVER['REQUEST_URI'], 1);
        $clean = explode('#', $clean)[0];
        $clean = explode('?', $clean)[0];
        $clean = (substr($clean, -1) != '/') ? $clean : substr($clean, 0, strlen($clean)-1);
        $explode = explode('/', $clean);
        return $explode;
    }

    private function segmentCounter($segments)
    {
        $response = false;
        $clean = explode('#', $_SERVER['REQUEST_URI'])[0];
        $clean = explode('?', $clean)[0];
        $explode = explode('/', substr($clean, 1));

        if (count($segments) == count($explode)) {
            foreach ($segments as $key => $segment) {
                if (strpos($segment, '{') === false && strpos($segment, '}') === false) {
                    if ($segment == $explode[$key]) {
                        $response = true;
                    }
                }
            }
        }

        return $response;
    }

    private function splitString($page, $options)
    {
        $class= false;
        $method = false;

        if (!empty($page)) {

            $class = (isset($page['controller'])) ? $page['controller'] : false;
            $method = (isset($page['method'])) ? $page['method'] : false;
            $as = (isset($page['as'])) ? $page['as'] : false;;
            $this->page['as'] = $as;
        }

        if ($class != false && $method != false) {

            $this->execute($class, $method, $options);
        }
    }

    public function where($controls, $page)
    {
        if (isset($page['where']) && is_array($page['where']) && !empty($page['where'])) {

            $where = $page['where'];
            foreach ($where as $key => $item) {
                $rule = $item;
                $value = (isset($controls[$key])) ? $controls[$key] : false;
                $confirm = '';
                if ($value != false) {

                    switch ($rule) {

                        case 'alpha':
                            $verif = ctype_alpha($value);
                            $confirm = ($verif) ? $verif : 'Variable {' . $key . '} must only contains letters';
                            break;

                        case 'numeric':
                            $verif = ctype_digit($value);
                            $confirm = ($verif) ? $verif : 'Variable {' . $key . '} must only contains numbers';
                            break;
                    }
                }
                if (is_string($confirm) && $confirm != '') {
                    trigger_error($confirm);
                }
            }
        }
    }

    private function execute($class, $method, $options)
    {
        define('VIEWINIT', true);
        if ($class == 'XhrController') {
            $controller = 'Quantic\\Igniter\\Workers\\' . $class;
        } else if ($class == 'Visio') {
            $controller = 'Quantic\\Visio\\' . $class;
        } else if ($class == 'ErrorsPage') {
            $controller = 'Quantic\\Igniter\\ErrorDocument\\' . $class;
        } else if (class_exists(config('chosen.namespace') . $class)) {
            $controller = config('chosen.namespace') . $class;
        } else {
            $controller = 'App\\Http\\Controllers\\' . $class;
        }
        $new = new $controller;

        if (class_exists($controller) && method_exists($controller, $method)) {

            $cl = new ReflectionClass($controller);
            $this->page['controller'] = $controller;
            $this->page['method'] = $method;
            $this->page['options'] = $options;
            $this->page['namespace'] = $cl->getNamespaceName();

            $_ENV['constellation']['main'] = $this->page;
            $new->$method(implode(',', $options));
        }
    }
}