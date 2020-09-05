<?php

namespace Quantic\Igniter\Workers;

use Ifsnop\Mysqldump as IMysqldump;

class Dumper
{
    private $dir = ROOTDIR . '/boson/dumps/';

    public function __construct()
    {
        $this->date();
    }

    private function date()
    {
        $dumps = $this->scan();
        $count = count($dumps);

        if (!empty($dumps)) {

            $limitedNumberOfDumps = intval(config('dumps.limit'));

            while ($count >= $limitedNumberOfDumps) {

                $file = $dumps[0];
                unlink($file);
                array_shift($dumps);
                $count--;
            }
        }
        $this->dump();
    }

    private function scan()
    {
        if (file_exists($this->dir)) {

            $dumps = scandir($this->dir);
            $files = [];

            foreach ($dumps as $dump) {

                if ($dump != '.' && $dump != '..' && is_file($this->dir . $dump)) {

                    $ext = explode('.', $dump)[count(explode('.', $dump))-1];

                    if ($ext == 'sql') {

                        array_push($files, $this->dir . $dump);
                    }
                }
            }

            return $files;

        } else {

            trigger_error('boson/dumps folder doesn\'t exist. Please create it in root project directory');
        }
    }

    private function dump()
    {
        $mysql = 'mysql:host=' . config('database.connections')[config('database.default')]['host'] . ';';
        $mysql .= 'dbname=' . config('database.connections')[config('database.default')]['database'];
        $username = config('database.connections')[config('database.default')]['username'];
        $password = config('database.connections')[config('database.default')]['password'];

        try {

            $dump = new IMysqldump\Mysqldump($mysql, $username, $password);
            $dump->start($this->dir . date("YmdHis") . '-' . config('app.name') . '-dump.sql');

        } catch (\Exception $e) {

            echo 'MySQL Dumper: ' . $e->getMessage();
        }
    }
}