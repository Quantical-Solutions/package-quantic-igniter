<?php

namespace Quantic\Igniter\Spectral;

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
        if (!empty($data)) {
            array_push(self::$reporter['models'], $data);
        }
    }

    public static function addMails($data)
    {
        if (!empty($data)) {
            self::$reporter['mails'] = $data;
        }
    }

    public static function addGates($data)
    {
        if (!empty($data)) {
            self::$reporter['gate'] = $data;
        }
    }

    public static function addQueries($queries, $traces)
    {
        $data = [];
        $groups = [];
        for ($i = 1; $i < count($queries); $i++) {
            $data[$i-1]['queries'] = $queries[$i];
            $data[$i-1]['traces'] = $traces[$i-1];
        }
        foreach ($data as $datum) {
            $group = [];
            $bindings = $datum['queries']['bindings'];
            $count = count($datum['queries']['bindings']);
            $bindedQuery = $datum['queries']['query'];

            if ($count > 0) {

                $cnt = substr_count($datum['queries']['query'], '?');
                $binds = [];
                for ($i = 0; $i < $cnt; $i++) {
                    array_push($binds, '?');
                }
                foreach ($bindings as $key => $binding) {
                    $b = (is_string($binding)) ? "' . $binding . '" : $binding;
                    $bindings[$key] = $b;
                }
                $bindedQuery = str_replace($binds, $bindings, $datum['queries']['query']);
            }

            $group['query'] = $bindedQuery;
            $group['time'] = $datum['queries']['time'];
            foreach ($datum['traces'] as $key => $trace) {
                if ($key == 'file') {
                    $datum['traces'][$key] = str_replace(ROOTDIR . '/', '', $trace);
                }
                $group['func'] = $datum['traces']['function'] . '(<span class="wormArgs">' . implode('</span>, <span class="wormArgs">', $datum['traces']['args']) . '</span>)';

                $group['loc'] = $datum['traces']['file'] . ':' . $datum['traces']['line'];

                $group['db'] = config('database.connections')[config('database.default')]['database'];

                if ($key == 'class' && $key == 'type') {

                    $group[$key] = $trace;
                }
            }
            array_push($groups, $group);
        }
        $array = array_values(
            array_map(
                "unserialize", array_unique(
                    array_map(
                        "serialize", $groups
                    )
                )
            )
        );
        self::$reporter['queries'] = $array;
    }

    private static function setTimeStamp()
    {
        return microtime(true);
    }

    public static function collect()
    {
        self::trimArray('models');
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

    private static function trimArray($type)
    {
        $array = array_values(
            array_map(
                "unserialize", array_unique(
                    array_map(
                        "serialize", self::$reporter[$type]
                    )
                )
            )
        );

        $final = end($array);
        $unique = self::arrayUnique($final);
        self::$reporter[$type] = $unique;
    }
}