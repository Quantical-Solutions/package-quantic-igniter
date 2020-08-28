<?php

namespace Quantic\Igniter\Workers;

use ErrorException;
use Quantic\Igniter\Wormhole\Wormhole;
use Quantic\Uxdebugger\Debugger as Uxdebug;
use Quantic\Igniter\Solutions\Solutions;

class ExceptionsHandler
{
    public static function HTMLBuilder($exception)
    {
        // Prepare Solution's options
        $solutions = Solutions::analyse();
        // Define errors params
        self::ini();
        // ignite BottomBarDebugger
        $debug = self::debugger();
        // Translate Severity Error
        $sev = self::severity($exception);
        // Compile error's data
        $data = self::compileData($exception, $sev);
        // Build ErrorsHandler template in buffer
        $log_message = self::prepareMessage($exception, $sev);
        // Prevent logs from XHR requests
        self::appendSession($log_message);
        // Display Error View
        ob_start();
        require_once(ROOTDIR . '/vendor/quantic/igniter/src/Workers/handlerAssets/head.php');
        require_once(ROOTDIR . '/vendor/quantic/igniter/src/Workers/handlerAssets/body.php');
        echo $debug;
        require_once(ROOTDIR . '/vendor/quantic/igniter/src/Workers/handlerAssets/footer.php');
        $content = ob_get_clean();
        echo $content;
    }

    private static function ini()
    {
        ini_set('error_reporting', E_ALL);
        ini_set("log_errors", TRUE);
        $timeZone = date_default_timezone_get();
        date_default_timezone_set($timeZone);
    }

    private static function debugger()
    {
        $uxDebugger = (class_exists('Quantic\Uxdebugger\Debugger')) ? Uxdebug::ignite() : false;
        return Wormhole::BottomBar(config('wormhole.bottombar'), $uxDebugger, []);
    }

    private static function solutions()
    {
        $solutions = [];
        $allClasses = get_declared_classes();
        return $solutions;
    }

    private static function severity($exception)
    {
        $error = new ErrorException;
        $names = [];
        $consts = array_flip(
            array_slice(
                get_defined_constants(true)['Core'], 0, 15, true));
        foreach ($consts as $code => $name) {
            if ($error->getSeverity() & $code) $names [] = $name;
        }
        foreach ($names as $key => $name) {
            $names[$key] = (isset(explode('_', $name)[count(explode('_', $name))-1])) ? explode('_', $name)[count(explode('_', $name))-1] : $name;
        }
        $sev = join(' | ', $names);
        return $sev;
    }

    private static function compileData($exception, $sev)
    {
        return [
            'solution' => 'My custom message',
            'severity' => $sev,
            'message' => $exception->getMessage(),
            'previous' => $exception->getPrevious(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'function' => 'exception_handler',
            'class' => 'Utils\ExceptionHandler',
            'type' => '::',
            'trace' => $exception->getTrace()
        ];
    }

    private static function prepareMessage($exception, $sev)
    {
        ob_start();
        echo '[' . date("Y-m-d H:i:s") . ' ' . date_default_timezone_get() . ']' . ' ' . $sev . ': ';
        echo $exception->getMessage() . "\n\n" . 'In file ' . $exception->getFile() . ' at line ' . $exception->getLine() . "\n\n";
        echo 'Stack Trace :' . "\n\n";
        $traces = $exception->getTrace();
        for ($i = 0; $i < count($traces); $i++) {
            $args = [];
            foreach ($traces[$i]['args'] as $arg) {
                if (!is_array($arg) && !is_object($arg)) {
                    array_push($args, $arg);
                } else {
                    array_push($args, 'Array');
                }
            }
            echo "\t" . '#' . $i . ' ' . $traces[$i]['file'] . '(' . $traces[$i]['line'] . '): ' . @$traces[$i]['class'] .
                @$traces[$i]['type'] . (($traces[$i]['function']) ? $traces[$i]['function'] . '(' . implode(', ', $args) . ')' : '') . "\n";
        }
        return ob_get_clean();
    }

    private static function appendSession($log_message)
    {
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            $_SESSION['exceptions'][date("YmsHis")] = $log_message;
        }
    }
}