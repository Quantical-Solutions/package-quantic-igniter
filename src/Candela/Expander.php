<?php

namespace Quantic\Igniter\Candela;

use Illuminate\Database\Capsule\Manager as Eloquent;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Expander
{
    /**
     * __construct method
     *
     * @return void
     * @access public
     */
    public function __construct()
    {
        try {

            if (config('database.default') !== null
                && isset(config('database.connections')[config('database.default')]['host'])
                && isset(config('database.connections')[config('database.default')]['database'])
                && isset(config('database.connections')[config('database.default')]['username'])
                && isset(config('database.connections')[config('database.default')]['password'])
                && isset(config('database.connections')[config('database.default')]['port'])
                && isset(config('database.connections')[config('database.default')]['charset'])
                && isset(config('database.connections')[config('database.default')]['collation'])
                && isset(config('database.connections')[config('database.default')]['prefix']))
            {

                $eloquent = new Eloquent;
                $eloquent->addConnection([
                    "driver" => config('database.default'),
                    "host" => config('database.connections')[config('database.default')]['host'],
                    "database" => config('database.connections')[config('database.default')]['database'],
                    "username" => config('database.connections')[config('database.default')]['username'],
                    "password" => config('database.connections')[config('database.default')]['password'],
                    "port" => config('database.connections')[config('database.default')]['port'],
                    'charset'   => config('database.connections')[config('database.default')]['charset'],
                    'collation' => config('database.connections')[config('database.default')]['collation'],
                    'prefix'    => config('database.connections')[config('database.default')]['prefix']
                ]);
                $eloquent->setEventDispatcher(new Dispatcher(new Container));
                $eloquent->setAsGlobal();
                $eloquent->bootEloquent();

            } else {

                throw new \Exception('Some variables aren\'t defined in the .init file... Please fill them to connect BDD.');
            }

        } catch (\Exception $e) {

            echo 'Message: ' . $e->getMessage();
        }
    }
}