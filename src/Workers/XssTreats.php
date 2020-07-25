<?php

namespace Quantic\Igniter\Workers;

class XssTreats
{
    public static array $request;

    public static function Requests()
    {
        $post = self::getPostRequest();
        $get = self::getGetRequest();
    }

    public static function getPostRequest()
    {
        //
    }

    public static function getGetRequest()
    {
        //
    }
}