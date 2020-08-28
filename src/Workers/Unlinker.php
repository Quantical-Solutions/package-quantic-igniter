<?php

namespace Quantic\Igniter\Workers;

class Unlinker
{
    public static function KillFiles()
    {
        if (file_exists(ROOTDIR . '/public/dist/styles.js')) {
            unlink(ROOTDIR . '/public/dist/styles.js');
        }
    }
}