<?php

namespace Quantic\Igniter\Workers;

use Quantic\Igniter\Workers\Request;

class XhrController
{
    public function index()
    {
        if (is_ajax()) {
            $request = Request::class;
            $method = '__xhr__' . $request::input('job');
            $this->$method($request);
        } else {
            redirectTo404ErrorPage();
        }
    }

    private function __xhr__deleter($request)
    {
        $type = $request::input('type');
        switch ($type) {
            case 'logs':
                $this->deleteExceptions();
                break;

            case 'dumps':
                $this->deleteDumps();
                break;
        }
    }

    private function deleteExceptions()
    {
        if (isset($_SESSION['exceptions'])) {
            unset($_SESSION['exceptions']);
        }
    }

    private function deleteDumps()
    {
        //
    }
}