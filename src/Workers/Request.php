<?php

namespace Quantic\Igniter\Workers;

class Request
{
    /**
     * all method
     * Get POST and GET incomes
     *
     * @return array
     */
    public static function all()
    {
        $post = self::getPostRequest();
        $get = self::getGetRequest();
        $data = [];
        $method = '';

        if ($post != false) { $data = $post; $method = 'POST'; }
        if ($get != false) { $data = $get; $method = 'GET'; }

        return [$data, $method];
    }

    /**
     * input method
     * Check POST and GET by input
     *
     * @param $options // input name
     * @return mixed
     */
    public static function input($options)
    {
        $response = 'Error : option argument(s) passed in "$request->input()" method doesn\'t exist.';
        $capture = self::all();
        $data = $capture[0];
        $method = $capture[1];

        if (is_string($options) && $method != '' && !empty($data)) {

            $inspector = self::stringTreatments($options, $data);
            $response = ($inspector != false) ? $inspector : $response;

        } else if (is_array($options) && $method != '' && !empty($data)) {

            $inspector = self::arrayTreatments($options, $data);
            $response = ($inspector != false) ? $inspector : $response;
        }

        return $response;
    }

    /**
     * getPostRequest method
     * Preserve POST inputs from XSS issues
     *
     * @return mixed
     */
    private static function getPostRequest()
    {
        $response = false;
        if (!empty($_POST)) {
            foreach ($_POST as $post) {
                $post = htmlspecialchars($post);
            }
            $response = $_POST;
        }
        return $response;
    }

    /**
     * getGetRequest method
     * Preserve GET inputs from XSS issues
     *
     * @return mixed
     */
    private static function getGetRequest()
    {
        $response = false;
        if (!empty($_GET)) {
            foreach ($_GET as $get) {
                $get = htmlspecialchars(urldecode($get));
            }
            $response = $_GET;
        }
        return $response;
    }

    /**
     * stringTreatments method
     *
     * @param $options
     * @param $data
     * @return mixed
     */
    public static function stringTreatments($options, $data)
    {
        $response = false;
        if (isset($data[$options])) {
            $response = $data[$options];
        }
        return $response;
    }

    /**
     * arrayTreatments method
     *
     * @param $options
     * @param $data
     * @return mixed
     */
    public static function arrayTreatments($options, $data)
    {
        $response = [];
        foreach ($data as $key => $opt) {
            if (in_array($key, $options)) {
                $response[$key] = $opt;
            } else {
                $response = false;
                break;
            }
        }
        return $response;
    }
}