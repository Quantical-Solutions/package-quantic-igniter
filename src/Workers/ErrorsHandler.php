<?php

namespace Quantic\Igniter\Workers;

use ErrorException;
use Quantic\Igniter\Wormhole\Wormhole;
use Quantic\Uxdebugger\Debugger as Uxdebug;
use Quantic\Igniter\Solutions\Solutions;
use Error;
use Illuminate\Database\Capsule\Manager as DB;

class ErrorsHandler
{
    public static function HTMLBuilder($severity, $message, $file, $line)
    {
        // Define errors params
        self::ini();
        // Get all queries
        $queries = DB::getQueryLog();
        // ignite BottomBarDebugger
        $debug = self::debugger();
        // Translate Severity Error
        $sev = self::severity($severity);
        // Compile error's data
        $data = self::compileData($message, $file, $line, $sev);
        // Build ErrorsHandler template in buffer
        $log_message = self::prepareMessage($message, $file, $line, $sev);
        // Prevent logs from XHR requests
        self::appendSession($log_message);
        // Get Dumps
        $dumpDir = ROOTDIR . '/boson/dumps/';
        $dumps = self::getDumps($dumpDir);
        // Display Error View
        ob_start();
        require_once(ROOTDIR . '/vendor/quantic/igniter/src/Workers/handlerAssets/head.php');
        require_once(ROOTDIR . '/vendor/quantic/igniter/src/Workers/handlerAssets/body.php');
        echo $debug;
        require_once(ROOTDIR . '/vendor/quantic/igniter/src/Workers/handlerAssets/footer.php');
        $content = ob_get_clean();
        echo $content;
    }

    private static function getDumps($dumpDir)
    {
        $dumps = [];
        if (file_exists($dumpDir)) {
            foreach (scandir($dumpDir) as $dump) {
                if ($dump != '.' && $dump != '..' && !is_dir($dumpDir . $dump)) {
                    array_push($dumps, $dump);
                }
            }
        }
        return $dumps;
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

    private static function severity($error)
    {
        $names = [];
        $consts = array_flip(
            array_slice(
                get_defined_constants(true)['Core'], 0, 15, true));
        foreach ($consts as $code => $name) {
            if ($error & $code) $names [] = $name;
        }
        foreach ($names as $key => $name) {
            $names[$key] = (isset(explode('_', $name)[count(explode('_', $name))-1])) ? explode('_', $name)[count(explode('_', $name))-1] : $name;
        }
        $sev = join(' | ', $names);
        return $sev;
    }

    private static function compileData($message, $file, $line, $sev)
    {
        $error = new Error;
        $traces = [];
        foreach ($error->getTrace() as $trace) {
            if (isset($trace['file'])) {
                array_push($traces, $trace);
            }
        }
        return [
            'error' => 'ErrorsHandler',
            'solution' => Solutions::analyse($message),
            'severity' => $sev,
            'message' => $message,
            'previous' => $error->getPrevious(),
            'code' => $error->getCode(),
            'file' => $file,
            'line' => $line,
            'function' => 'error_handler',
            'class' => 'Utils\ErrorsHandler',
            'type' => '::',
            'trace' => $traces
        ];
    }

    private static function prepareMessage($message, $file, $line, $sev)
    {
        $error = new Error;
        $traces = [];
        foreach ($error->getTrace() as $trace) {
            if (isset($trace['file'])) {
                array_push($traces, $trace);
            }
        }
        ob_start();
        echo '[' . date("Y-m-d H:i:s") . ' ' . date_default_timezone_get() . ']' . ' ' . $sev . ': ';
        echo $message . "\n\n" . 'In file ' . $file . ' at line ' . $line . "\n\n";
        echo 'Stack Trace :' . "\n\n";
        $cnt = 0;
        for ($i = 0; $i < count($traces); $i++) {
            $args = [];
            if (isset($traces[$i]['args'])) {
                foreach ($traces[$i]['args'] as $arg) {
                    if (!is_array($arg) && !is_object($arg)) {
                        array_push($args, $arg);
                    } else {
                        array_push($args, 'Array');
                    }
                }
            }
            $classe = (isset($traces[$i]['class'])) ? $traces[$i]['class'] : '';
            $type = (isset($traces[$i]['type'])) ? $traces[$i]['type'] : '';
            $fil = (isset($traces[$i]['file'])) ? $traces[$i]['file'] : '';
            $lin = (isset($traces[$i]['line'])) ? $traces[$i]['line'] : '';
            echo "\t" . '#' . $i . ' ' . $fil . '(' . $lin . '): ' . $classe . $type . (($traces[$i]['function']) ? $traces[$i]['function'] . '(' . implode(', ', $args) . ')' : '') . "\n";
            $cnt++;
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