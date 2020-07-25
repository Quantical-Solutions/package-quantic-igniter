<?php

namespace Quantic\Igniter\Workers;

class Request
{
    public function input($options)
    {
        $response = 'Error : option argument(s) passed in "$request->input()" method doesn\'t exist.';
        $post = $this->getPostRequest();
        $get = $this->getGetRequest();
        $data = [];
        $method = '';

        if ($post != false) { $data = $post; $method = 'POST'; }
        if ($get != false) { $data = $get; $method = 'GET'; }

        if (is_string($options) && $method != '' && !empty($data)) {

            $inspector = $this->stringTreatments($options, $data);
            $response = ($inspector != false) ? $inspector : $response;

        } else if (is_array($options) && $method != '' && !empty($data)) {

            $inspector = $this->arrayTreatments($options, $data);
            $response = ($inspector != false) ? $inspector : $response;
        }

        return $response;
    }

    private function getPostRequest()
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

    private function getGetRequest()
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

    public function stringTreatments($options, $data)
    {
        $response = false;
        if (isset($data[$options])) {
            $response = $data[$options];
        }
        return $response;
    }

    public function arrayTreatments($options, $data)
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