<?php

namespace Quantic\Igniter\Candela;

use ReflectionException;

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
     * @throws ReflectionException
     * @access public
     */
    public function singleton($concrete = false, $interface = false)
    {
        $response = false;

        if ($interface != false && $concrete != false) {

            $reflect = new \ReflectionClass($concrete);

            if ($reflect && $reflect->implementsInterface($interface)) {
                $response = true;
            }
        }

        return $response;
    }
}