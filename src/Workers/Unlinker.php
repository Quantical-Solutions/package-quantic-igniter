<?php

namespace Quantic\Igniter\Workers;

class Unlinker
{
    public static function KillFiles()
    {
        @unlink(ROOTDIR . '/public/dist/styles.js');
    }
}