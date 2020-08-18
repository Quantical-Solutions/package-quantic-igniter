<?php

$code = $_SERVER['REDIRECT_STATUS'];

$error = 'Unknown error';

$codes = [
    200 => 'Not Found',
    403 => 'Forbidden',
    404 => 'Not Found',
    500 => 'Server Error'
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