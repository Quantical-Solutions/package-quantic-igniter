<?php

namespace Quantic\Igniter\Candela;

class BigBang
{
    /**
     * Environment root directory
     *
     * @var string
     * @access private
     */
    private $env = '';

    /**
     * Class Constructor
     *
     * @param string $env environment variable
     * @return void
     * @access public
     */
    public function __construct($env)
    {
        $this->env = $env;
    }

    /**
     * Singleton method
     *
     * @param mixed $interface Interface
     * @param mixed $concrete Implement Interface to concrete Class
     * @return bool
     * @access public
     */
    public function singleton($interface = false, $concrete = false)
    {
        $response = false;

        if ($interface != false && $concrete != false) {

            if (class_exists($concrete) && in_array($interface, class_implements($concrete))) {

                $response = true;
                new $concrete;
            }
        }

        return $response;
    }
}