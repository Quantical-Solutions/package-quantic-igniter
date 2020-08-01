<?php

namespace Quantic\Igniter\Candela;

use Illuminate\Database\Capsule\Manager as Eloquent;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Expander
{
    /**
     * EloquentIgniter method
     *
     * @return void
     * @access public
     */
    public static function EloquentIgniter()
    {
        try {

            if (defined('DB_CONNECTION')
                && defined('DB_HOST')
                && defined('DB_DATABASE')
                && defined('DB_USERNAME')
                && defined('DB_PASSWORD')
                && defined('DB_PORT')
                && defined('DB_CHARSET')
                && defined('DB_COLLATION')
                && defined('DB_PREFIX'))
            {

                $eloquent = new Eloquent;
                $eloquent->addConnection([
                    "driver" => DB_CONNECTION,
                    "host" => DB_HOST,
                    "database" => DB_DATABASE,
                    "username" => DB_USERNAME,
                    "password" => DB_PASSWORD,
                    "port" => DB_PORT,
                    'charset'   => DB_CHARSET,
                    'collation' => DB_COLLATION,
                    'prefix'    => DB_PREFIX
                ]);
                $eloquent->setEventDispatcher(new Dispatcher(new Container));
                $eloquent->setAsGlobal();
                $eloquent->bootEloquent();

            } else {

                throw new \Exception('Some constants aren\'t defined in the .env file... Please fill them to connect BDD.');
            }

        } catch (\Exception $e) {

            echo 'Message: ' . $e->getMessage();
        }
    }
}