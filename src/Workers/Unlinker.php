<?php

namespace Quantic\Igniter\Workers;

class Unlinker
{
    public static function KillStyles()
    {
        @unlink(ROOTDIR . '/public/dist/styles.js');
    }
}