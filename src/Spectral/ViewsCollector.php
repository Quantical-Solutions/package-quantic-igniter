<?php

namespace Quantic\Igniter\Spectral;

class ViewsCollector
{

    public static function viewParser($data)
    {
        $view = $data['view'];
        $paths = $data['paths'] . '/' . $view . '.blade.php';
        $realPaths = ROOTDIR . $paths;
        $params = $data['params'];
        $file = file($realPaths);

        $views = [
            [
                'name' => str_replace('/', '.', $view),
                'view' => $view,
                'paths' => $paths,
                'params' => (new self)->getUsedParams($file),
                'allParams' => $params
            ]
        ];

        $subber = (new self)->subViewsParser($file, $params, ROOTDIR . $data['paths']);
        foreach ($subber as $sub) {
            array_push($views, $sub);
        }

        return $views;
    }

    protected function getUsedParams($file)
    {
        $used = [];
        $final = [];

        foreach ($file as $line) {

            $single = $this->get_string_between($line, '{{ $', ' }}');
            $singleTrimmed = $this->get_string_between($line, '{{$', '}}');
            $object = $this->get_string_between($line, '{{ $', '->');
            $objectTrimmed = $this->get_string_between($line, '{{$', '->');
            $array = $this->get_string_between($line, '{{ $', '[');
            $arrayTrimmed = $this->get_string_between($line, '{{$', '[');
            $raw = $this->get_string_between($line, '$', ')');
            $raw2 = $this->get_string_between($line, '$', ';');

            if (!empty($single)) array_push($used, $single);
            if (!empty($singleTrimmed)) array_push($used, $singleTrimmed);
            if (!empty($object)) array_push($used, $object);
            if (!empty($objectTrimmed)) array_push($used, $objectTrimmed);
            if (!empty($array)) array_push($used, $array);
            if (!empty($arrayTrimmed)) array_push($used, $arrayTrimmed);
            if (!empty($raw)) array_push($used, $raw);
            if (!empty($raw2)) array_push($used, $raw2);
        }

        foreach ($used as $use) {
            foreach ($use as $u) {
                array_push($final, $u);
            }
        }

        return $final;
    }

    protected function get_string_between($str, $startDelimiter, $endDelimiter)
    {
        $contents = array();
        $startDelimiterLength = strlen($startDelimiter);
        $endDelimiterLength = strlen($endDelimiter);
        $startFrom = $contentStart = $contentEnd = 0;

        while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {

            $contentStart += $startDelimiterLength;
            $contentEnd = strpos($str, $endDelimiter, $contentStart);

            if (false === $contentEnd) { break; }

            $trimmed = trim(substr($str, $contentStart, $contentEnd - $contentStart));
            $contents[] = $trimmed;
            $startFrom = $contentEnd + $endDelimiterLength;
        }

        return $contents;
    }

    protected function subViewsParser($originalFile, $params, $root)
    {
        $views = [];

        // Extends files

        foreach ($originalFile as $line) {
            $extends = $this->get_string_between($line, '@extends(', ')');
            if (!empty($extends)) array_push($views, $extends);

            foreach ($extends as $view) {

                $newPaths = $root . '/' . trim(str_replace('\'', '', str_replace('"', '', str_replace('.', '/', $view)))) . '.blade.php';
                // Includes files

                foreach (file($newPaths) as $line) {

                    //====================================================

                    // @include('view.name') directive parser
                    $include = $this->includes(
                        'include',
                        $this->get_string_between($line, '@include(', ')')
                    );
                    if (!empty($include)) array_push($views, $include);

                    // @include('view.name', ['some' => 'data']) directive parser
                    $includeWithData = $this->includes(
                        'include',
                        $this->get_string_between($line, '@include(', ',')
                    );
                    if (!empty($includeWithData)) array_push($views, $includeWithData);

                    //====================================================

                    // @includeIf('view.name') directive parser
                    $includeIf = $this->includes(
                        'includeIf',
                        $this->get_string_between($line, '@includeIf(', ')')
                    );
                    if (!empty($includeIf)) array_push($views, $includeIf);

                    // @includeIf('view.name', ['some' => 'data']) directive parser
                    $includeIfWithData = $this->includes(
                        'includeIf',
                        $this->get_string_between($line, '@includeIf(', ',')
                    );
                    if (!empty($includeIf)) array_push($views, $includeIfWithData);

                    //====================================================

                    // @includeWhen($boolean, 'view.name') directive parser
                    $includeWhen = $this->includes(
                        'includeWhen',
                        $this->get_string_between($line, '@includeWhen(', ')')
                    );
                    if (!empty($includeWhen)) array_push($views, $includeWhen);

                    // @includeWhen($boolean, 'view.name', ['some' => 'data']) directive parser
                    $includeWhenWithData = $this->includes(
                        'includeWhen',
                        $this->get_string_between($line, '@includeWhen(', ')')
                    );
                    if (!empty($includeWhenWithData)) array_push($views, $includeWhenWithData);

                    //====================================================

                    // @includeUnless($boolean, 'view.name') directive parser
                    $includeUnless = $this->includes(
                        'includeUnless',
                        $this->get_string_between($line, '@includeUnless(', ')')
                    );
                    if (!empty($includeUnless)) array_push($views, $includeUnless);

                    // @includeUnless($boolean, 'view.name', ['some' => 'data']) directive parser
                    $includeUnlessWithData = $this->includes(
                        'includeUnless',
                        $this->get_string_between($line, '@includeUnless(', ')')
                    );
                    if (!empty($includeUnlessWithData)) array_push($views, $includeUnlessWithData);

                    //====================================================

                    // @includeFirst(['custom.admin', 'admin']) directive parser
                    $includeFirst = $this->includes(
                        'includeFirst',
                        $this->get_string_between($line, '@includeFirst(', ')')
                    );
                    if (!empty($includeFirst)) array_push($views, $includeFirst);

                    // @includeFirst(['custom.admin', 'admin'], ['some' => 'data']) directive parser
                    $includeFirstWithData = $this->includes(
                        'includeFirst',
                        $this->get_string_between($line, '@includeFirst(', ',')
                    );
                    if (!empty($includeFirstWithData)) array_push($views, $includeFirstWithData);
                }
            }
        }

        return $this->collectViews($views, $root, $params);
    }

    protected function includes($mode, $data)
    {
        $final = [];
        if (!empty($data)) {
            switch ($mode) {

                case 'include':

                    foreach ($data as $file) {
                        array_push($final, $file);
                    }
                    break;

                case 'includeIf':

                    break;

                case 'includeWhen':

                    break;

                case 'includeUnless':

                    break;

                case 'includeFirst':

                    break;
            }
        }

        return $final;
    }

    protected function collectViews($views, $root, $params)
    {
        $final = [];
        foreach ($views as $view) {
            foreach ($view as $vars) {

                $vars = trim(str_replace('\'', '', $vars));
                $vars = trim(str_replace('"', '', $vars));
                $vars = trim(str_replace('.', '/', $vars));
                $subFile = file($root . '/' . $vars . '.blade.php');

                $sub = [
                    'name' => str_replace('.', '/', $vars),
                    'view' => $vars,
                    'paths' => str_replace(ROOTDIR, '', $root) . '/' . $vars . '.blade.php',
                    'params' => $this->getUsedParams($subFile),
                    'allParams' => $params
                ];

                array_push($final, $sub);
            }
        }

        return $final;
    }
}