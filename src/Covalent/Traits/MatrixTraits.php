<?php

namespace Quantic\Igniter\Covalent\Traits;

use Quantic\Igniter\Spectral\Glows;
use Quantic\Igniter\Spectral\Context;

trait MatrixTraits
{

    public function Context($name, $string)
    {
        return Context::capture($name, $string);
    }

    public function ContextGroup($name, $array)
    {
        return Context::group($name, $array);
    }

    public function Glow($message, $level, $args)
    {
        return Glows::capture($message, $level, $args);
    }
}