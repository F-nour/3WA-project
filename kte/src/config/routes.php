<?php
return [
    url('/') => [
        '\App\Controller\Guest\HomepageController',
        'index'
    ],
    url('/about') => [
        '\App\Controller\Guest\AboutController',
        'index'
    ],
    url('/legal') => [
        '\App\Controller\Guest\LegalController',
        'index'
    ],
    url('/login') => [
        '\App\Controller\Guest\UserController',
        'login'
    ],
    url('/register') => [
        '\App\Controller\Guest\UserController',
        'register'
    ],
    url('/create') => [
        '\App\Controller\Guest\UserController',
        'create'
    ],
    url('/auth') => [
        '\App\Controller\Guest\UserController',
        'auth'
    ],
    url('/logout') => [
        '\App\Controller\Guest\UserController',
        'logout'
    ],
    url('/account') => [
        '\App\Controller\Guest\UserController',
        'account'
    ],
    url('/modifyUser') => [
        '\App\Controller\Guest\UserController',
        'modify'
    ],
    url('/updateUser') => [
        '\App\Controller\Guest\UserController',
        'updateUser'
    ],
    url('/updatePassword') => [
        '\App\Controller\Guest\UserController',
        'updatePassword'
    ],
    url('/updatePwd') => [
        '\App\Controller\Guest\UserController',
        'updatePwd'
    ],
    url('/deleteAccount') => [
        '\App\Controller\Guest\UserController',
        'deleteAccount'
    ],
    url('/admin') => [
        '\App\Controller\Admin\AdminController',
        'index'
    ],
    url('/admin/editAbout') => [
        '\App\Controller\Admin\AdminController',
        'editAbout'
    ],
    url('/admin/updateAboutForm') => [
        '\App\Controller\Admin\AdminController',
        'updateAboutForm'
    ],
];
