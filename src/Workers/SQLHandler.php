<?php

namespace Quantic\Igniter\Workers;

use ErrorException;
use Quantic\Igniter\Wormhole\Wormhole;
use Quantic\Uxdebugger\Debugger as Uxdebug;
use Quantic\Igniter\Solutions\Solutions;
use Error;
use Illuminate\Database\Capsule\Manager as DB;

class SQLHandler
{
    public static function HTMLBuilder($exception)
    {
        // Define errors params
        self::ini();
        // Get all queries
        $queries = DB::getQueryLog();
        // Translate Severity Error
        $sev = self::severity($exception);
        // Compile error's data
        $data = self::compileData($exception, $sev);
        // ignite BottomBarDebugger
        $debug = self::debugger($data);
        // Build ErrorsHandler template in buffer
        $log_message = self::prepareMessage($exception, $sev);
        // Prevent logs from XHR requests
        self::appendSession($log_message);
        // Get Dumps
        $dumpDir = ROOTDIR . '/boson/dumps/';
        $dumps = self::getDumps($dumpDir);
        // Get IDE command
        $ide = self::getIDE();
        // Get IDE name
        $ideTitle = self::getIDEName();
        // Display Error View
        ob_start();
        require_once(ROOTDIR . '/vendor/quantic/igniter/src/Workers/handlerAssets/head.php');
        require_once(ROOTDIR . '/vendor/quantic/igniter/src/Workers/handlerAssets/body.php');
        echo $debug;
        require_once(ROOTDIR . '/vendor/quantic/igniter/src/Workers/handlerAssets/footer.php');
        $content = ob_get_clean();
        echo $content;
    }

    private static function getIDEName()
    {
        $title = '<b class="purple">PhpStorm</b>';
        switch (config('app.ide')) {
            case 'phpstorm': $title = '<b class="purple">PhpStorm</b>'; break;
            case 'sublime': $title = '<b class="orange">Sublime Text</b>'; break;
            case 'vscode': $title = '<b class="blue">Visual Studio Code</b>'; break;
            case 'atom': $title = '<b class="green">Atom</b>'; break;
        }
        return $title;
    }

    private static function getIDE()
    {
        $ide = 'phpstorm://open?file=';
        switch (config('app.ide')) {
            case 'phpstorm': $ide = 'phpstorm://open?file='; break;
            case 'sublime': $ide = 'sublime://open?file='; break;
            //case 'sublime': $ide = 'sublime://open?url=file://'; break;
            case 'vscode': $ide = 'vscode://open?file='; break;
            case 'atom': $ide = 'atom://open?file='; break;
        }
        return $ide;
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

    private static function debugger($data)
    {
        $uxDebugger = (class_exists('Quantic\Uxdebugger\Debugger')) ? Uxdebug::ignite() : false;
        return Wormhole::BottomBar(config('wormhole.bottombar'), $uxDebugger, [], $data);
    }

    private static function severity($exception)
    {
        $message = $exception->getMessage();
        $title = explode('[' . $exception->getCode() . ']', $message)[0];
        return $title;
    }

    private static function compileData($exception, $sev)
    {
        return [
            'error' => 'SQLHandler',
            'solution' => Solutions::analyse($exception->getMessage()),
            'severity' => $sev  . ' [ ' . $exception->getCode() . ' ]',
            'message' => trim(str_replace($sev . '[' . $exception->getCode() . ']:', '', $exception->getMessage())),
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
            $file = (isset($traces[$i]['file'])) ? $traces[$i]['file'] : '';
            $line = (isset($traces[$i]['line'])) ? $traces[$i]['line'] : '';
            echo "\t" . '#' . $i . ' ' . $file . '(' . $line . '): ' . $classe . $type . (($traces[$i]['function']) ? $traces[$i]['function'] . '(' . implode(', ', $args) . ')' : '') . "\n";
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