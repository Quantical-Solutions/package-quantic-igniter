<?php

$code = $_SERVER['REDIRECT_STATUS'];

$error = 'Unknown error';

$codes = [
    403 => 'Forbidden',
    404 => 'Not Found',
    500 => 'Internal Server Error'
];

$source_url = 'http'.((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 's' : '').'://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if (array_key_exists($code, $codes) && is_numeric($code)) {

    $error =  "$code | {$codes[$code]}";
}

?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
    <meta name="referrer" content="origin-when-cross-origin">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="msapplication-tap-highlight" content="no" />
    <title>Quantic - $error</title>
    <link rel="icon" href="/dimension/media/img/favicon.png">
    <link rel="stylesheet" href="/dimension/dist/styles.css" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</head>
<body>
<div style="width: 100%; height: 100vh; display: flex; justify-content: center; align-items: center;">
    <h1><?= $error ?></h1>
</div>
<script type="text/javascript" src="/dimension/dist/scripts.js" ></script>
</body>
</html>
