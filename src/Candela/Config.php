<?php

namespace Quantic\Igniter\Candela;

use Carbon\Carbon;
use Jenssegers\Blade\Blade;
use Quantic\Igniter\Wormhole\Wormhole;
use Quantic\Uxdebugger\Debugger as Uxdebug;

class Config
{
    /**
     * ConvertEnvConstants method
     * Convert all .env parameters in constants
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

    public static function views($view, $data = false) {

        $resources = '/resources/views';
        $cache = '/divine/cache/blade';

        if (!defined('CHECKRENDER')) {
            define('CHECKRENDER', true);
        }

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
    }

    public static function createSVGForlder()
    {
        @mkdir(ROOTDIR . '/dimension/svg');
    }

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

                @unlink(ROOTDIR . '/sitemap.xml');
                @unlink(ROOTDIR . '/robots.txt');
                self::sitemap_generator();
            }
        }
    }

    public static function sitemap_builder($where) {

        $nav = config('app.navigation');
        ob_start();
        echo '<ul>';
        foreach ($nav as $row) {
            if ($row['place'] === $where) { ?>
                <li>
                    <a href="<?= config('app.url') . $row['url'] ?>"><?= $row['titre'] ?> - url: <i><?= $row['url'] ?></i></a>
                </li>
            <?php }
        }
        echo '</ul>';
        $content = ob_get_clean();
        return ($content != '<ul></ul>') ? $content : '';
    }

    public static function is_ajax() {

        $response = false;
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $response = true;
        }
        return $response;
    }

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

    public static function unlinkSymlinker($link) {

        if (!file_exists($link)) {
            if (isset($_SERVER['WINDIR']) && ($_SERVER['WINDIR'] || $_SERVER['windir'])) {
                exec('junction -d "' . $link . '"');
            } else {
                unlink($link);
            }
        }
    }

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

    public static function init($declaration, $default = null) {

        $response = $default;
        $initArray = Config::ConvertEnvConstants();

        if (is_string($declaration) && isset($initArray[$declaration])) {

            $response = $initArray[$declaration];
        }

        return $response;
    }

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

    public static function storage_path($data) {

        return $data;
    }
}