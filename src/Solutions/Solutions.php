<?php

namespace Quantic\Igniter\Solutions;

class Solutions
{
    private static array $solutions = [];
    private static array $views;
    private static string $view;
    private static array $classes;
    private static array $functions;
    private static array $viewVars = [];
    public static string $possibleView = '';

    public static function analyse($message)
    {
        self::getFunctions();
        self::getClasses();
        self::getViewVars();
        return self::getSolution($message);
    }

    public static function addViews($array)
    {
        self::$views = $array;
    }

    public static function askedView($view)
    {
        self::$view = $view;
        self::findPossibleView();
    }

    public static function addSolution($message, $description)
    {
        if (is_string($message)) {
            if (is_string($description)) {
                array_push(self::$solutions, array('message' => $message, 'description' => $description));
            } else {
                trigger_error('Solutions::addSolution() second argument must be a String type');
            }
        } else {
            trigger_error('Solutions::addSolution() first argument must be a String type');
        }
    }

    private static function getFunctions()
    {
        $user = get_defined_functions()['user'];
        $internal = get_defined_functions()['internal'];
        $methods = [];
        $classes = get_declared_classes();
        foreach ($classes as $class) {
            $meths = get_class_methods($class);
            foreach ($meths as $meth) {
                array_push($methods, $meth);
            }
        }
        $unique = array_unique($methods);
        $merge = array_merge($user, $internal);
        $finalMerge = array_merge($merge, $unique);
        self::$functions = $merge;
    }

    private static function getClasses()
    {
        $classes = get_declared_classes();
        $final = [];
        foreach ($classes as $key => $class) {
            array_push($final, $class);
        }
        self::$classes = $final;
    }

    private static function getViewVars()
    {
        if (isset($_ENV['constellation']['main']['data'])
            && !empty($_ENV['constellation']['main']['data'])) {
            $options = $_ENV['constellation']['main']['data'];
            $final = [];
            foreach ($options as $index => $option) {
                array_push($final, $index);
            }
            self::$viewVars = $final;
        }
    }

    private static function findPossibleView()
    {
        $all = self::$views;
        $asked = self::$view;
        $indices = [];
        foreach ($all as $view) {
            similar_text($view, $asked, $percent);
            $matcher = intval($percent);
            array_push($indices, $matcher);
        }
        $value = max($indices);
        $key = array_search($value, $indices);
        self::$possibleView = $all[$key];
    }

    private static function getSolution($message)
    {
        $solutions = self::$solutions;
        $final = [];
        foreach ($solutions as $solution) {
            if ($message == $solution['message']) {
                $final = $solution;
                break;
            }
        }
        if (empty($final)) {

            $desc = '';

            if (strpos($message, 'Call to undefined function') !== false) {

                $functions = self::$functions;
                $split = explode(' ', $message)[count(explode(' ', $message))-1];
                $track = str_replace('()', '', explode('\\', $split)[count(explode('\\', $split))-1]);
                $indices = [];

                if (!empty($functions)) {

                    foreach ($functions as $function) {
                        similar_text($function, $track, $percent);
                        $matcher = intval($percent);
                        array_push($indices, $matcher);
                    }

                    $value = max($indices);
                    $key = array_search($value, $indices);
                    $desc = $functions[$key] . '()';
                }

            } else if (strpos($message, 'Undefined variable') !== false) {

                $track = explode(' ', $message)[count(explode(' ', $message))-1];
                $vars = self::$viewVars;
                $indices = [];

                if (!empty($vars)) {

                    foreach ($vars as $var) {
                        similar_text($var, $track, $percent);
                        $matcher = intval($percent);
                        array_push($indices, $matcher);
                    }

                    $value = max($indices);
                    $key = array_search($value, $indices);
                    $desc = '$' . $vars[$key];
                }

            } else if (strpos($message, 'Class \'') !== false
                && strpos($message, '\' not found') !== false) {

                $replace = str_replace(
                    '\' not found', '', str_replace(
                        'Class \'', '', $message
                    )
                );
                $track = explode('\\', $replace)[count(explode('\\', $replace))-1];

                $classes = self::$classes;
                $indices = [];

                if (!empty($classes)) {

                    foreach ($classes as $class) {
                        $cl = explode('\\', $class)[count(explode('\\', $class))-1];
                        similar_text($class, $track, $percent);
                        $matcher = intval($percent);
                        array_push($indices, $matcher);
                    }

                    $value = max($indices);
                    $key = array_search($value, $indices);
                    $desc = $classes[$key];
                }
            }

            $final = ($desc != '') ? [
                'message' => $message,
                'description' => 'Did you mean <b>' . $desc . '</b> ?'
            ] : [];
        }
        return $final;
    }
}