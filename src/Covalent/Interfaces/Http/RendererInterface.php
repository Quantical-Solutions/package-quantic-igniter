<?php

namespace Quantic\Igniter\Covalent\Interfaces\Http;

interface RendererInterface
{
    public function save($data);
    public static function getInstance();
}