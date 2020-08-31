<?php

namespace Quantic\Igniter\Candela;

use Carbon\Carbon;
use Jenssegers\Blade\Blade;
use Quantic\Igniter\Wormhole\Wormhole;
use Quantic\Uxdebugger\Debugger as Uxdebug;
use Quantic\Igniter\Solutions\Solutions;

class Config
{
    /**
     * ConvertEnvConstants method
     * Get all .init file constants
     *
     * @return array
     */
    public static function ConvertEnvConstants()
    {
        $response = [];
        if (file_exists(ROOTDIR . '/.init')
            && strpos(file_get_contents(ROOTDIR . '/.init'), '=') !== false) {

            $env_file = file_get_contents(ROOTDIR . '/.init');
            $lines = explode("\n", $env_file);

            foreach ($lines as $line) {

                if (strpos($line, '=') !== false) {

                    $constant = trim(explode('=', $line)[0]);
                    $value = trim(explode('=', $line)[1]);

                    if (strpos($value, '"${') === 0
                        && strpos($value, '}"') === strlen($value) - 2) {

                        $length = strlen($value) - 5;
                        $slice = substr($value, 3, $length);
                        $response[$constant] = $slice;

                    } else {

                        $response[$constant] = $value;
                    }
                }
            }
        }
        return $response;
    }

    /**
     * uriSegments method
     * Convert REQUEST_URI in array.
     *
     * @return array
     */
    public static function uriSegments()
    {
        $uris = $_SERVER['REQUEST_URI'];
        $explode = explode('/', $uris);
        return $explode;
    }

    /**
     * views method
     * Convert Select the blade view corresponding to the URL.
     *
     * @param $view
     * @param mixed $data
     * @return void
     */
    public static function views($view, $data = false) {

        $resources = '/resources/views';
        $cache = '/divine/cache/blade';

        if (!defined('CHECKRENDER')) {
            define('CHECKRENDER', true);
        }

        $scan = scandir(ROOTDIR . $resources);
        $allViews = [];
        foreach ($scan as $file) {
            if ($file != '.' && $file != '..') {
                $newRoot = ROOTDIR . $resources . '/' . $file;
                if (is_dir($newRoot)) {
                    $newViews = self::listAllViews($newRoot, ROOTDIR . $resources);
                    if (!empty($newViews)) {
                        foreach ($newViews as $newView) {
                            $new = str_replace(
                                '.blade.php', '', str_replace(
                                    ROOTDIR . $resources . '/', '', $newView
                                )
                            );
                            array_push($allViews, $new);
                        }
                    }
                } else {
                    if (is_file($newRoot)) {
                        $new = str_replace(
                            '.blade.php', '', str_replace(
                                ROOTDIR . $resources . '/', '', $newRoot
                            )
                        );
                        array_push($allViews, $new);
                    }
                }
            }
        }

        Solutions::addViews($allViews);
        Solutions::askedView($view);

        addSolution(
            'The Blade\'s view [ ' . $view . ' ] doesn\'t exist.',
            'Did you mean <b>[ ' . Solutions::$possibleView . ' ]</b> ?'
        );

        if (file_exists(ROOTDIR . $resources . '/' . $view . '.blade.php')) {

            $_ENV['constellation']['main']['view'] = $view;
            $_ENV['constellation']['main']['data'] = $data;
            $blade = new Blade(ROOTDIR . $resources, ROOTDIR . $cache);
            $original = $blade->render($view, $data);

            $uxDebugger = (class_exists('Quantic\Uxdebugger\Debugger')) ? Uxdebug::ignite() : false;
            $debug = Wormhole::BottomBar(config('wormhole.bottombar'), $uxDebugger, array(
                'view' => $view,
                'params' => array_keys($data),
                'paths' => $resources
            ));

            $content = explode('</body>', $original)[0] . PHP_EOL;
            $closure = $debug . PHP_EOL . '</body>' . explode('</body>', $original)[1];
            echo $content . $closure;

        } else {
            trigger_error('The Blade\'s view [ ' . $view . ' ] doesn\'t exist.');
        }
    }

    /**
     * listAllViews method
     * A list of all existing views
     *
     * @param $root
     * @param $origin
     * @return array
     */
    private static function listAllViews($root, $origin)
    {
        $allViews = [];
        $scan = scandir($root);
        foreach ($scan as $file) {
            if ($file != '.' && $file != '..') {
                $newRoot = $root . '/' . $file;
                if (is_dir($newRoot)) {
                    $newViews = self::listAllViews($newRoot, $origin);
                    if (!empty($newViews)) {
                        foreach ($newViews as $newView) {
                            $new = str_replace(
                                '.blade.php', '', str_replace(
                                    $origin . '/', '', $newView
                                )
                            );
                            array_push($allViews, $new);
                        }
                    }
                } else {
                    if (is_file($newRoot)) {
                        $new = str_replace(
                            '.blade.php', '', str_replace(
                                $origin . '/', '', $newRoot
                            )
                        );
                        array_push($allViews, $new);
                    }
                }
            }
        }
        return $allViews;
    }

    /**
     * createSVGFolder method
     * Create de SVGs folder if not exists
     *
     * @return void
     */
    public static function createSVGFolder()
    {
        if (!file_exists(ROOTDIR . '/resources/svg')) {
            mkdir(ROOTDIR . '/resources/svg');
        }
    }

    /**
     * import_svg method
     * Import a svg file from the SVG folder and build a HTML Element containing de asked svg file
     *
     * @param $file
     * @param $class
     * @param mixed $array
     * @return mixed
     */
    public static function import_svg($file, $class, $array = false)
    {
        $js = '';
        if ($array != false) {
            foreach ($array as $foo) {

                $js .= ' ' . $foo[0] . '="' . $foo[1] . '"';
            }
        }

        $path = ROOTDIR . '/dimension/svg/' . $file . '.svg';
        if (file_exists($path)) {

            ob_start();
            $inner = str_replace('<svg ', '<svg class="' . explode(' ', $class)[0] . '_svg" ', file_get_contents($path));

            if (strpos($inner, '<title>') !== false && strpos($inner, '</title>') !== false) {

                $final1 = substr($inner, 0, strpos($inner, '<title>'));
                $final2 = substr($inner, strpos($inner, '</title>'), strlen($inner));
                $final = $final1 . $final2;

            } else {

                $final = $inner;
            }

            echo '<div class="' . $class . '"' . $js . '>' . $final . '</div>';
            $svg = ob_get_clean();
            return $svg;
        }
    }

    /**
     * sitemap_generator method
     * Build the sitemap.xml and robot.txt files at the project's root
     *
     * @return void
     */
    public static function sitemap_generator() {

        if (config('app.env') !== 'production') {

            $navigation = config('app.navigation');
            $array = [];

            foreach ($navigation as $row) {

                $page = [$row['titre'], $row['url']];

                $priority = ($row['titre'] == 'Accueil' || $row['titre'] == 'Le Blog' || $row['titre'] == 'Tous nos spécialistes' ||
                    $row['titre'] == 'L\'offre Astro Consult\'' || $row['titre'] == 'Les tarifs conseillés') ? '1' : '0.9';

                array_push($page, $priority);
                array_push($array, $page);
            }

            $dir = scandir(ROOTDIR);
            $checker = 0;
            foreach ($dir as $file) { if ($file == 'sitemap.xml') { $checker++; } }
            $all = [];

            $onglets = $array;

            foreach ($onglets as $onglet) {
                array_push($all, $onglet);
            }

            if ($checker == 0) {

                $doc = new \DOMDocument('1.0', 'UTF-8');
                $doc->formatOutput = true;
                $nav = $doc->createElement('urlset');
                $att = $doc->createAttribute('xmlns');
                $att->value = 'http://www.sitemaps.org/schemas/sitemap/0.9';
                $nav->appendChild($att);
                $nav = $doc->appendChild($nav);

                foreach ($all as $onglet) {

                    $em = $doc->createElement('url');

                    $li1 = $doc->createElement('loc', (config('app.url') . $onglet[1]));
                    $em->appendChild($li1);
                    $li2 = $doc->createElement('lastmod', date('Y-m-d'));
                    $em->appendChild($li2);
                    $li3 = $doc->createElement('changefreq', 'weekly');
                    $em->appendChild($li3);
                    $li4 = $doc->createElement('priority', $onglet[2]);
                    $em->appendChild($li4);
                    $li5 = $doc->createElement('xhtml:link');
                    $att1 = $doc->createAttribute('rel');
                    $att1->value = 'alternate';
                    $li5->appendChild($att1);
                    $att2 = $doc->createAttribute('hreflang');
                    $att2->value = 'fr';
                    $li5->appendChild($att2);
                    $att3 = $doc->createAttribute('href');
                    $att3->value = config('app.url') . $onglet[1];
                    $li5->appendChild($att3);
                    $em->appendChild($li5);

                    $nav->appendChild($em);
                }

                $doc->save('sitemap.xml');

                $fp = fopen('robots.txt', 'w');
                $string = 'Sitemap: ' . config('app.url') . '/sitemap.xml';
                fwrite($fp, $string);
                fclose($fp);

            } else {

                if (file_exists(ROOTDIR . '/sitemap.xml')) {
                    unlink(ROOTDIR . '/sitemap.xml');
                }
                if (ROOTDIR . '/robots.txt') {
                    unlink(ROOTDIR . '/robots.txt');
                }
                self::sitemap_generator();
            }
        }
    }

    /**
     * is_ajax method
     * Check if the Request sent is an XMLHttpRequest type
     *
     * @return boolean
     */
    public static function is_ajax() {

        $response = false;
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $response = true;
        }
        return $response;
    }

    /**
     * symlinker method
     * Create symlinks
     *
     * @param $target
     * @param $link
     * @return void
     */
    public static function symlinker($target, $link) {

        if (!file_exists($link)) {
            if (isset($_SERVER['WINDIR']) && ($_SERVER['WINDIR'] || $_SERVER['windir'])) {
                exec('junction "' . $link . '" "' . $target . '"');
            } else {
                symlink($target, $link);
                echo readlink($link);
            }
        }
    }

    /**
     * unlinkSymlinker method
     * Delete symlink from the symlinks list
     *
     * @return void
     */
    public static function unlinkSymlinker($link) {

        if (!file_exists($link)) {
            if (isset($_SERVER['WINDIR']) && ($_SERVER['WINDIR'] || $_SERVER['windir'])) {
                exec('junction -d "' . $link . '"');
            } else {
                unlink($link);
            }
        }
    }

    /**
     * config method
     * Convert all globals files and their contents in root scope variables
     *
     * @param $str
     * @return mixed
     */
    public static function config($str) {

        $globals = ROOTDIR . '/globals/';
        $response = 'Wrong string parameter format in config() function : ' . $str . ' isn\'t a valid argument.';

        if (count(explode('.', $str)) == 2) {

            $component = strtolower(explode('.', $str)[0]);
            $index = strtolower(explode('.', $str)[1]);

            $files = scandir($globals);

            foreach ($files as $file) {

                $var = strtolower(str_replace('.php', '', $file));

                if ($component == $var) {

                    $content = require($globals . $file);
                    $response = $content[$index];
                    break;
                }
            }
        }

        return $response;
    }

    /**
     * init method
     * Convert .init file constants in root scope variables
     *
     * @param $declaration
     * @param mixed $default
     * @return mixed
     */
    public static function init($declaration, $default = null) {

        $response = $default;
        $initArray = Config::ConvertEnvConstants();

        if (is_string($declaration) && isset($initArray[$declaration])) {

            $response = $initArray[$declaration];
        }

        return $response;
    }

    /**
     * humanizeSize method
     * Convert octets in readable information for human
     *
     * @param $space
     * @return string
     */
    public static function humanizeSize($space) {

        if ($space / pow(1024, 4) < 1 && $space / pow(1024, 3) >= 1) {
            $used = number_format(($space / pow(1024, 3)), 1, '.', ' ') . 'GB';
        } else if ($space / pow(1024, 3) < 1 && $space / pow(1024, 2) >= 1) {
            $used = number_format(($space / pow(1024, 2)), 1, '.', ' ') . 'MB';
        } else if ($space / pow(1024, 2) < 1 && $space / 1024 >= 1) {
            $used = number_format(($space / 1024), 1, '.', ' ') . 'KB';
        } else if ($space / 1024 < 1 && $space >= 1) {
            $used = number_format($space, 1, '.', ' ') . 'B';
        } else {
            $used = '0B';
        }

        return $used;
    }

    /**
     * storage_path method
     * Build the sitemap.xml and robot.txt files at the project's root
     *
     * @param $data
     * @return string
     */
    public static function storage_path($data) {

        return $data;
    }
}