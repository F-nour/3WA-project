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
        '\App\Controller\UserController',
        'login'
    ],
    url('/register') => [
        '\App\Controller\UserController',
        'register'
    ],
    url('/create') => [
        '\App\Controller\UserController',
        'create'
    ],
    url('/auth') => [
        '\App\Controller\UserController',
        'auth'
    ],
    url('/logout') => [
        '\App\Controller\UserController',
        'logout'
    ],
    url('/account') => [
        '\App\Controller\UserController',
        'account'
    ],
    url('/modify') => [
        '\App\Controller\UserController',
        'modify'
    ],
    url('/updateUser') => [
        '\App\Controller\UserController',
        'updateUser'
    ],
    url('/updatePassword') => [
        '\App\Controller\UserController',
        'updatePassword'
    ],
    url('/updatePwd') => [
        '\App\Controller\UserController',
        'updatePwd'
    ],
    url('/admin/') => [
        '\App\Controller\AdminController',
        'index'
    ],
];
