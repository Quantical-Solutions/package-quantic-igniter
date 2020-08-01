<?php

namespace Quantic\Igniter\Covalent\Interfaces\Http;

interface LauncherInterface
{
    public function save($data);
    public static function getInstance();
}