<?php

use Quantic\Igniter\Candela\Config as Config;
use Quantic\Igniter\Workers\ErrorsHandler;
use Quantic\Igniter\Workers\ExceptionsHandler;
use Quantic\Igniter\Workers\SQLHandler;
use Quantic\Igniter\Solutions\Solutions;
use Quantic\Igniter\Workers\SwiftMailerCollector as Mail;
use Quantic\Igniter\ErrorDocument\ErrorsPage;
use Quantic\Chosen\Matrix\Deploy;
use Quantic\Chosen\Matrix\Auth;

define('QUANTIC_START', microtime(true));

$path = explode('/vendor' , __DIR__)[0];
define('ROOTDIR', $path);

/**
 * init function
 *
 * Convert all .init file data to be accessible in all the app
 */
if (!function_exists('init')) {
    function init($declaration, $default = null)
    {
        return Config::init($declaration, $default);
    }
}

/**
 * config function
 *
 * Convert all global folder files array to be accessible in all the app
 */
if (!function_exists('config')) {
    function config($str)
    {
        return Config::config($str);
    }
}

$newSessionName = str_replace('-', '_', str_replace(' ', '_', strtolower(config('app.name'))) . '_session');
if (session_name() != $newSessionName) { session_name($newSessionName); }
session_start();

if (class_exists(Deploy::class)) {
    new Deploy;
}

include_once ROOTDIR .'/vendor/owasp/csrf-protector-php/libs/csrf/csrfprotector.php';
csrfProtector::init();

/**
 * redirectTo404ErrorPage function
 *
 * Get 404 server response if uri's not in Constellation references
 */
if (!function_exists('redirectTo404ErrorPage')) {
    function redirectTo404ErrorPage()
    {
        http_response_code(404);
        $error = new ErrorsPage;
        $error->ignite(404);
    }
}

/**
 * terminate function
 *
 * Terminate app process
 */
if (!function_exists('terminate')) {
    function terminate()
    {
        if (is_ajax()) {
            define('CHECKRENDER', true);
        }
        if (!defined('CHECKRENDER')) {
            redirectTo404ErrorPage();
        }
        $_SESSION['_previous'] = (($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    }
}

/**
 * constellation function
 *
 * Translated to URL relative path.
 */
if (!function_exists('constellation')) {
    function constellation($uri)
    {
        $explode = explode('/', $uri);
        $recomp = [];
        foreach ($explode as $segment) {
            array_push($recomp, urlencode($segment));
        }
        return '/' . implode('/', $recomp);
    }
}

/**
 * session function
 *
 * Convert all $_SESSION data to be accessible in all the app
 */
if (!function_exists('session')) {
    function session($key = false)
    {
        $return = [];
        if ($key == false) {
            $return = $_SESSION;
        } else {
            if (isset($_SESSION[$key])) {
                $return = $_SESSION[$key];
            } else {
                $return = false;
            }
        }
        return $return;
    }
}

/**
 * newer function
 *
 * Get $_SESSION['new'] array.
 */
if (!function_exists('new')) {
    function newer($key = false)
    {
        $return = [];
        if ($key == false) {
            $return = $_SESSION['new'];
        } else {
            if (isset($_SESSION['new'][$key])) {
                $return = $_SESSION['new'][$key];
            } else {
                trigger_error('$_SESSION[\'new\'][\'' . $key . '\'] does not exist');
            }
        }
        return $return;
    }
}

/**
 * old function
 *
 * Get $_SESSION['old'] array.
 */
if (!function_exists('old')) {
    function old($key = false)
    {
        $return = [];
        if ($key == false) {
            $return = $_SESSION['old'];
        } else {
            if (isset($_SESSION['old'][$key])) {
                $return = $_SESSION['old'][$key];
            } else {
                trigger_error('$_SESSION[\'old\'][\'' . $key . '\'] does not exist');
            }
        }
        return $return;
    }
}

/**
 * views function
 *
 * Generate views with Blade engine
 */
if (!function_exists('views')) {
    function views($view, $data = false)
    {
        Config::views($view, $data);
    }
}

/**
 * humanizeSize function
 *
 * Translate octets to a human scale
 */
if (!function_exists('humanizeSize')) {
    function humanizeSize($space)
    {
        return Config::humanizeSize($space);
    }
}

/**
 * storage_path function
 *
 * Define the storage path
 */
if (!function_exists('storage_path')) {
    function storage_path($data)
    {
        return Config::storage_path($data);
    }
}

/**
 * resource_path function
 *
 * Define the resources path
 */
if (!function_exists('resource_path')) {
    function resource_path($path)
    {
        return Config::resource_path($path);
    }
}

/**
 * exception_handler function
 *
 * Exceptions callback
 */
if (!function_exists('exception_handler')) {
    function exception_handler($exception)
    {
        ob_clean();
        ExceptionsHandler::HTMLBuilder($exception);
        exit();
    }
}

/**
 * error_handler function
 *
 * Errors callback
 */
if (!function_exists('error_handler')) {
    function error_handler($severity, $message, $file, $line)
    {
        ob_clean();
        ErrorsHandler::HTMLBuilder($severity, $message, $file, $line);
        exit();
    }
}

/**
 * sql_handler function
 *
 * SQL Exceptions callback
 */
if (!function_exists('sql_handler')) {
    function sql_handler($error)
    {
        ob_clean();
        SQLHandler::HTMLBuilder($error);
        exit();
    }
}

/**
 * import_svg function
 *
 * Get svg files and convert content in string
 */
if (!function_exists('import_svg')) {
    function import_svg($file, $class, $array = false)
    {
        return Config::import_svg($file, $class, $array);
    }
}

/**
 * sitemap_generator function
 *
 * Generate sitemap.xml file
 */
if (!function_exists('sitemap_generator')) {
    function sitemap_generator()
    {
        Config::sitemap_generator();
    }
}

/**
 * is_jax function
 *
 * Controls if request is an XHR type
 */
if (!function_exists('is_ajax')) {
    function is_ajax()
    {
        return Config::is_ajax();
    }
}

/**
 * addSolutions function
 *
 * References solutions to the Wormhole
 */
if (!function_exists('addSolution')) {
    function addSolution($message, $description)
    {
        Solutions::addSolution($message, $description);
    }
}

/**
 * setDB function
 *
 * Set DB connexion with Eloquent ORM
 */
if (!function_exists('setDB')) {
    function setDB()
    {
        Config::setDB();
    }
}

/**
 * wormAddMessage function
 *
 * References messages to the Wormhole
 */
if (!function_exists('wormAddMessage')) {
    function wormAddMessage($data, $level = 0)
    {
        Config::addMessage($data, $level);
    }
}

/**
 * wormAddModel function
 *
 * References models to the Wormhole
 */
if (!function_exists('wormAddModel')) {
    function wormAddModel($data)
    {
        Config::addModel($data);
    }
}

/**
 * wormAddQueries function
 *
 * References queries to the Wormhole
 */
if (!function_exists('wormAddQueries')) {
    function wormAddQueries($queries, $traces)
    {
        Config::addQueries($queries, $traces);
    }
}

/**
 * wormAddMail function
 *
 * References mails to the Wormhole
 */
if (!function_exists('wormAddMail')) {
    function wormAddMail($array)
    {
        Config::addMails($array);
    }
}

/**
 * wormAddGates function
 *
 * References gates to the Wormhole
 */
if (!function_exists('wormAddGates')) {
    function wormAddGates($array)
    {
        Config::addGates($array);
    }
}

/**
 * wormCollect function
 *
 * Collect reported data for the Wormhole debugBar
 */
if (!function_exists('wormCollect')) {
    function wormCollect()
    {
        return Config::collect();
    }
}

/**
 * sendMail function
 *
 * Send mail using SwiftMailer Package
 */
if (!function_exists('sendMail')) {
    function sendMail($data)
    {
        Mail::sendMail($data);
    }
}

/**
 * symlinker function
 *
 * Add a symlink to the link list
 */
if (!function_exists('symlinker')) {
    function symlinker()
    {
        Config::symlinker();
    }
}

/**
 * unlinkSymlinker function
 *
 * Delete a link from the symlink list
 */
if (!function_exists('unlinkSymlinker')) {
    function unlinkSymlinker($link)
    {
        //Config::unlinkSymlinker('symlink_you_want_to_delete')
        Config::unlinkSymlinker($link);
    }
}

/**
 * chrono function
 *
 * Get time stamp in seconds
 */
if (!function_exists('chrono')) {
    function chrono()
    {
        return explode(' ', microtime())[0] . ' s';
    }
}

/**
 * tracer function
 *
 * Return file from a given index in debug_backtrace() array
 */
if (!function_exists('tracer')) {
    function tracer($index)
    {
        $debug = debug_backtrace();
        return $debug[$index]['file'];
    }
}

/**
 * csrf_token function
 *
 * Return CSRF Token
 */
if (!function_exists('csrf_token')) {
    function csrf_token()
    {
        return end($_SESSION['_token']);
    }
}

/**
 * csrf_field function
 *
 * Return <input> HTML Tag for Blade @csrf call
 */
if (!function_exists('csrf_field')) {
    function csrf_field()
    {
        return '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    }
}

/**
 * redirectTo function
 *
 * Redirect to domain.com/uri
 */
if (!function_exists('redirectTo')) {
    function redirectTo($uri)
    {
        $slice = (strpos($uri, '/') === 0) ? substr($uri, 1) : $uri;
        header('Location: /' . $slice);
    }
}

/*
 * ==================================================================
 * ============================ Set Links ===========================
 * ==================================================================
 */

symlinker();

//Auth::set(1);
Auth::reset();

/*
 * ==================================================================
 * ===================== Set Session attributes =====================
 * ==================================================================
 */

if (!isset($_SESSION['_previous'])) { $_SESSION['_previous'] = ''; }
$_SESSION['locale'] = config('app.locale');
if (!isset($_SESSION['_flash'])) { $_SESSION['_flash'] = ['old' => [], 'new' => []]; }

/*
 * ==================================================================
 * ========================== Set Handlers ==========================
 * ==================================================================
 */

set_exception_handler('exception_handler');
set_error_handler('error_handler');