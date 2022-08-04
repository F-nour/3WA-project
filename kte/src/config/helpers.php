<?php

/**
 * @file helpers.php
 * @brief Fonctions d'aides pour l'application.
 * @author Nour-eddine
 */

use Library\Auth\Authentifier;
use Library\HTML\Accessibility;
use Library\HTML\Form;
use Library\Session\Flashbag;
use Library\Validator\AboutValidator;
use Library\Validator\ActualityValidator;
use Library\Validator\ContactValidator;
use Library\Validator\ProductValidator;
use Library\Validator\UserValidator;

/**
 * @brief Fonction de redirection.
 * @function url(string $path) Retourne une URL absolue.
 * @param string $path : Chemin de la page à rediriger.
 * @return void
 */
function url(string $path): string
{
    return '/kte' . $path;
}

/**
 * @brief Redirection function.
 * @function logAction(string $type, string $name, string $message) Logs an action.
 * @param string $type : Type of the error.
 * @param string $name : Name of the error.
 * @param string $message : Message of the error.
 * @variable $logdir : Directory of the log file.
 * @variable $logFile : File of the log
 * @return void
 */

function flash(): Flashbag
{
    return new Flashbag();
}

function auth(): Authentifier
{
    return new Authentifier();
}

function aboutForm(): AboutValidator
{
    return new AboutValidator();
}

function actualityForm(): ActualityValidator
{
    return new ActualityValidator();
}

function contactForm(): ContactValidator
{
    return new ContactValidator();
}

function productForm(): ProductValidator
{
    return new ProductValidator();
}

function userForm(): UserValidator
{
    return new UserValidator();
}

function form(): Form
{
    return new Form();
}

function accessibility(): Accessibility
{
    return new Accessibility();
}

function purify(string $value): string
{
    $value = htmlspecialchars($value);
    $value = trim($value);
    $value = strip_tags($value);
    $value = stripslashes($value);
    return $value;
}