<?php

namespace Quantic\Igniter\Covalent\Interfaces\Console;

interface LauncherInterface
{
    public function save($data);
    public static function getInstance();
}