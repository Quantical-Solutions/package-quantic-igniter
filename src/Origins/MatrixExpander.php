<?php

namespace Quantic\Igniter\Origins;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as DB;
use Quantic\Igniter\Covalent\Traits\MatrixTraits;
use Quantic\Igniter\Covalent\Traits\VortexTraits;

class MatrixExpander extends Model
{
    use MatrixTraits;
    use VortexTraits;

    public static array $models = [];
    public static array $queries = [];
    public static array $traces = [];

    public static function collect()
    {
        $queries = DB::getQueryLog();
        $traces = debug_backtrace();
        $realTraces = [];
        self::models($traces, $queries);

        foreach ($traces as $trace) {
            if ($trace['function'] == 'hydrate'
                && !empty($trace['args'])
                && isset($trace['args'][0])
                && !empty($trace['args'][0])) {

                array_push($realTraces, $trace['args'][0]);
            }
        }

        $class = get_called_class();
        if (!empty($realTraces)) {
            $array = [
                'class' => $class,
                'objects' => []
            ];
            foreach ($realTraces[0] as $cle => $realTrace) {
                array_push($array['objects'], spl_object_id($realTrace));
            }
            array_push(self::$models, $array);
        }
    }

    private static function models($traces, $queries)
    {
        $arrayQueries = [];

        foreach ($queries as $query) {
            foreach ($query as $cle => $item) {
                $arrayQueries[$cle] = $item;
            }
        }

        array_push(self::$queries, $arrayQueries);
        $arrayTraces = [];
        foreach ($traces as $trace) {
            if (isset($trace['class'])
                && ($trace['class'] == 'Quantic\Chosen\Matrix\Auth' || strpos($trace['class'], 'App\Http\Controllers') !== false)) {
                foreach ($trace as $key => $value) {
                    $arrayTraces[$key] = $value;
                }
                break;
            }
        }

        array_push(self::$traces, $arrayTraces);
    }
}