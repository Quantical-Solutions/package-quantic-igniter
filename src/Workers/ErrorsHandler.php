<?php

namespace Quantic\Igniter\Workers;

use ErrorException;
use Quantic\Igniter\Wormhole\Wormhole;
use Quantic\Uxdebugger\Debugger as Uxdebug;

class ErrorsHandler
{
    public static function HTMLBuilder($exception)
    {
        $log_dir = ROOTDIR . '/vendor/quantic/igniter/src/Workers/logs/error_logs.php';
        ini_set('error_reporting', E_ALL);
        ini_set("log_errors", TRUE);

        $uxDebugger = (class_exists('Quantic\Uxdebugger\Debugger')) ? Uxdebug::ignite() : false;
        $debug = Wormhole::BottomBar(config('wormhole.bottombar'), $uxDebugger, []);

        $exceptionsAssets = ROOTDIR . '/vendor/quantic/igniter/src/Workers';

        $sev = 'ERROR';

        if ($exception instanceof ErrorException) {
            $names = [];

            $consts = array_flip(
                array_slice(
                    get_defined_constants(true)['Core'], 0, 15, true));

            foreach ($consts as $code => $name) {
                if ($exception->getSeverity() & $code) $names [] = $name;
            }

            $sev = join(' | ', $names);
        }

        $data = [
            'custom' => 'My custom message',
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

        ob_start();
        require_once($exceptionsAssets . '/handlerAssets/head.php');
        require_once($exceptionsAssets . '/handlerAssets/body.php');
        echo $debug;
        require_once($exceptionsAssets . '/handlerAssets/footer.php');
        $content = ob_get_clean();

        $timeZone = date_default_timezone_get();
        date_default_timezone_set($timeZone);
        $title = date("Y-m-d H:i:s") . ' ' . $timeZone;
        $message = $exception->getMessage() . ' in ' . $exception->getFile() . ' at line ' . $exception->getLine();

        ob_start();
        echo '[' . $title . ']' . ' ' . $sev . ': ';
        echo $message . "\n";
        echo 'Stack Trace :' . "\n";

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

        $log_message = ob_get_clean();

        $encode = urlencode(strtolower($exception->getMessage()));
        if (!isset($_SESSION['last_exception'][$encode])
            || (isset($_SESSION['last_exception'][$encode])
                && intval(date("is")) - intval($_SESSION['last_exception'][$encode]) > 10)
        ) {
            //error_log($log_message, 3, $log_dir);
            $_SESSION['exceptions'][date("YmsHis")] = $log_message;
            $_SESSION['last_exception'][$encode] = date("is");
        }
        echo $content;
    }
}