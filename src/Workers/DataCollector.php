<?php

namespace Quantic\Igniter\Workers;

class DataCollector
{
    public static array $reporter = ['messages' => [], 'models' => [], 'queries' => [], 'mails' => [], 'gate' => []];

    public static function addMessage($data, $level)
    {
        if (is_int($level) && $level >= 0 && $level <= 3) {

            if (!is_array($data) && !is_object($data)) {

                $response = [
                    'message' => $data,
                    'is_html' => self::is_html($data),
                    'is_string' => self::is_string($data),
                    'type' => self::type($level),
                    'time' => self::setTimeStamp()
                ];

            } else {

                $response = [
                    'message' => $data,
                    'is_html' => false,
                    'is_string' => false,
                    'type' => self::type($level),
                    'time' => self::setTimeStamp()
                ];
            }

            array_push(self::$reporter['messages'], $response);

        } else {

            trigger_error('wormAddMessage() second parameter must be Int type between 0 and 3');
        }
    }

    private static function is_html($data)
    {
        return preg_match("/<[^<]+>/",$data,$m) != 0;
    }

    private static function is_string($data)
    {
        $response = false;
        if (is_string($data)) {
            $response = true;
        }
        return $response;
    }

    private static function type($type)
    {
        switch ($type) {
            case 0:  $response = 'DUMP'; break;
            case 1:  $response = 'INFO'; break;
            case 2:  $response = 'WARNING'; break;
            case 3:  $response = 'ERROR'; break;
        }

        return $response;
    }

    public static function addModel($data)
    {
        $response = [
            'test' => $data
        ];

        if (!empty($data)) {
            array_push(self::$reporter['models'], $data);
        }
    }

    public static function addQuery($data)
    {
        $response = [
            'test' => $data
        ];
        array_push(self::$reporter['queries'], $response);
    }

    private static function setTimeStamp()
    {
        return microtime(true);
    }

    public static function collect()
    {
        self::trimModels();
        return self::$reporter;
    }

    private static function arrayUnique($array)
    {
        $final = [];
        if (is_array($array)) {

            foreach ($array as $key => $model) {

                $cle = strtolower(str_replace('\\', '_', $model['class']));

                if (!isset($final[$cle])) {

                    $final[$cle]['class'] = $model['class'];
                    $final[$cle]['objects'] = [];
                }

                foreach ($model['objects'] as $object) {

                    if (!in_array($object, $final[$cle]['objects'])) {

                        array_push($final[$cle]['objects'], $object);
                    }
                }
            }
        }
        return $final;
    }

    private static function trimModels()
    {
        $array = array_values(
            array_map(
                "unserialize", array_unique(
                    array_map(
                        "serialize", self::$reporter['models']
                    )
                )
            )
        );

        $final = end($array);
        $unique = self::arrayUnique($final);
        self::$reporter['models'] = $unique;
    }
}