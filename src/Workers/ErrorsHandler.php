<?php

namespace Quantic\Igniter\Workers;

class ErrorsHandler
{
    public static function DisplayErrors()
    {
        ini_set('error_prepend_string',"<div class='errorPhp'><p><span style='color: white; width: 100%;'>Erreur <b style='color: white;'>PHP</b> de type</span>");
        ini_set('error_append_string',"</p></div><script src='https://" . $_SERVER['SERVER_NAME'] . "/assets/js/errors.js'></script>");
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(-1);
    }
}