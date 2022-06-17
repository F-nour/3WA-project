<?php

/**
 * @file helpers.php
 * @brief Fonctions d'aides pour l'application.
 * @author Nour-eddine
 */

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
function logAction(string $type, string $name, string $message): void
{
    $logdir = dirname(__DIR__) . "/logs/$type/$name/" . date('Ymd');
    $logfile = $logdir . DIRECTORY_SEPARATOR . $type . '_' . $name . '_' . date('Ymd_H-i-s') . '.log';
    if (!file_exists($logdir)) {
        mkdir($logdir, 0777, true);
    }
    file_put_contents(
        $logfile,
        date('d/m/Y H:i') . " : " . $message . ' - ' . $_SERVER['REQUEST_URI'] . " ",
        FILE_APPEND
    );
}
