<?php

namespace Quantic\Igniter\Covalent\Interfaces\Debug;

interface HandlerInterface
{
    public function display();
    public function save($data);
    public static function getInstance();
}