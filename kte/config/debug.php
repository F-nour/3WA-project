<?php

/**
 * @brief debug file
 * @file debug.phh
 */

/* it's importing the VarDump class and the PrettyPageHandler class from the Whoops package.*/

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

// vardumper

/* Importing the VarCloner class from the Symfony VarDumper component. */

/**
 * @brief Mode de développement
 * @var $whoops Whoops error handler.
 */

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

