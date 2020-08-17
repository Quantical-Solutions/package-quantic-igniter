<?php

namespace Quantic\Igniter\Spectral;

use Quantic\Igniter\Workers\Constellation;

class ConstellationCollector
{
    public function constellationParser()
    {
        $nav = require_once(ROOTDIR . '/constellations/links.php');
    }
}