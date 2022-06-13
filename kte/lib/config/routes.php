<?php

function url(string $path): string
{
    return '/kte'  . $path;
}

return [
    url('/') => [
        '\App\Controller\HomepageController',
        'index'
    ],
    url('/about') => [
        '\App\Controller\AboutController',
        'index'
    ],
    url('/legal') => [
        '\App\Controller\LegalController',
        'index'
    ],
    url('/login') => [
        '\App\Controller\LoginController',
        'index'
    ],
];
