<?php

return [
    'xhr_post' => [
        'uri' => '/xmlhttprequests',
        'controller' => 'XhrController',
        'method' => 'index',
        'request' => 'post',
        'as' => 'XHR'
    ],
    'xhr_get' => [
        'uri' => '/xmlhttprequests',
        'controller' => 'XhrController',
        'method' => 'index',
        'request' => 'get',
        'as' => 'XHR'
    ],
    'visio' => [
        'uri' => '/' . config('app.visio'),
        'controller' => 'Visio',
        'method' => 'ignite',
        'request' => 'get',
        'as' => 'Visio'
    ],
    'errors' => [
        'uri' => '/error/{x}',
        'controller' => 'ErrorsPage',
        'method' => 'ignite',
        'request' => 'get',
        'as' => 'Errors',
        'where' => ['x' => 'numeric']
    ]
];