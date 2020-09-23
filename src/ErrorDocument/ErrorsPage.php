<?php

namespace Quantic\Igniter\ErrorDocument;

use Carbon\Carbon;
use Jenssegers\Blade\Blade;

class ErrorsPage
{
    public function ignite($err)
    {
        $code = $err;

        $error = 'Unknown error';

        $codes = [
            200 => 'Not Found',
            400 => 'Bad Request',
            403 => 'Forbidden',
            404 => 'Not Found',
            406 => 'Not Acceptable',
            408 => 'Request Time-out',
            409 => 'Conflict',
            413 => 'Payload Too Large',
            500 => 'Server Error',
            502 => 'Bad Gateway',
            503 => 'Service Temporarily Unavailable',
            504 => 'Gateway Time-out',
            507 => 'Insufficient Storage'
        ];

        $source_url = 'http'.((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 's' : '').'://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $type = 200;
        $message = 'All\'s good';

        if (array_key_exists($code, $codes) && is_numeric($code)) {

            if ($code == 200) {
                $type = 404;
            } else {
                $type = $code;
            }

            $message =  $codes[$code];
        }

        $resources = (file_exists(ROOTDIR . '/resources/views/customErrors/errors.blade.php'))
            ? ROOTDIR . '/resources/views/customErrors'
            : __DIR__ . '/views';

        $blade = new Blade($resources, __DIR__ . '/cache');
        echo $blade->render('errors', ['type' => $type, 'message' => $message]);
        exit();
    }
}