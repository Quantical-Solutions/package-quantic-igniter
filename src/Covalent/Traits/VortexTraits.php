<?php

namespace Quantic\Igniter\Covalent\Traits;

use Quantic\Igniter\Spectral\Vortex;

trait VortexTraits
{
    public function vortex($name)
    {
        $configVortex = ROOTDIR . '/config/vortex.php';
        if (file_exists($configVortex) && function_exists('config')) {

            $class = (config('vortex.vortex'))[$name];
            new $class;

        } else {

            trigger_error('Vortex config file does not exist');
        }
    }
}