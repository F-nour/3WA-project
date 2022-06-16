<?php

/**
 * @file routes.php
 * @brief Routes configuration file.
 */
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
