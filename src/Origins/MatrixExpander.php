<?php

namespace Quantic\Igniter\Origins;

use Illuminate\Database\Eloquent\Model;

class MatrixExpander extends Model
{
    use \Quantic\Igniter\Covalent\Traits\MatrixTraits;

    public static array $models = [];

    public static function collect()
    {
        $traces = debug_backtrace();
        $realTraces = [];

        foreach ($traces as $trace) {
            if ($trace['function'] == 'hydrate'
                && !empty($trace['args'])
                && isset($trace['args'][0])
                && !empty($trace['args'][0])) {

                array_push($realTraces, $trace['args'][0]);
            }
        }

        //dump($realTraces);

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
}