<?php

namespace Quantic\Igniter\Spectral;

class ViewsCollector
{
    protected function viewParser($data)
    {
        $view = $data['view'];
        $paths = $data['paths'] . '/' . $view . '.blade.php';
        $realPaths = ROOTDIR . $paths;
        $params = $data['params'];
        $file = file($realPaths);

        $views = [
            [
                'name' => str_replace('.', '/', $view),
                'view' => $view,
                'paths' => $paths,
                'params' => $this->getUsedParams($file),
                'allParams' => $params
            ]
        ];

        $subber = $this->subViewsParser($file, $params, ROOTDIR . $data['paths']);
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

            $contents[] = trim(substr($str, $contentStart, $contentEnd - $contentStart));
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
        }

        // Includes files

        foreach ($originalFile as $line) {
            $this->includes(
                'include',
                $this->get_string_between($line, '@include(', ')')
            );
        }

        foreach ($originalFile as $line) {
            $this->includes(
                'includeIf',
                $this->get_string_between($line, '@includeIf(', ','),
            );
        }

        foreach ($originalFile as $line) {
            $this->includes(
                'includeWhen',
                $this->get_string_between($line, '@includeWhen(', ')')
            );
        }

        foreach ($originalFile as $line) {
            $this->includes(
                'includeUnless',
                $this->get_string_between($line, '@includeUnless(', ')')
            );
        }

        foreach ($originalFile as $line) {
            $this->includes(
                'includeFirst',
                $this->get_string_between($line, '@includeFirst(', ')')
            );
        }

        return $this->collectViews($views, $root, $params);
    }

    protected function includes($mode, $data)
    {
        switch ($mode) {

            case 'include':

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
        return true;
    }

    protected function collectViews($views, $root, $params)
    {
        $final = [];
        foreach ($views as $view) {
            foreach ($view as $vars) {
                $vars = trim(str_replace('\'', '', $vars));
                $vars = trim(str_replace('"', '', $vars));
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