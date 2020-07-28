<?php

namespace Quantic\Igniter\Covalent\Interfaces\Console;

interface RendererInterface
{
    public function save($data);
    public static function getInstance();
}