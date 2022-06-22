<?php

/**
 * @file helpers.php
 * @brief Fonctions d'aides pour l'application.
 * @author Nour-eddine
 */

use Library\Auth\Authentifier;
use Library\Session\Flashbag;
use Library\Log\Logger;
use Library\Validator\Validator;

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

function validForm(): Validator
{
    return new Validator();
}