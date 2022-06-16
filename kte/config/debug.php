<?php

/**
 * @brief Mode de développement
 * @var $whoops Whoops error handler.
 */
$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

// vardumper

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\ContextProvider\CliContextProvider;
use Symfony\Component\VarDumper\Dumper\ContextProvider\SourceContextProvider;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use Symfony\Component\VarDumper\Dumper\ServerDumper;
use Symfony\Component\VarDumper\VarDumper;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

$cloner = new VarCloner();
$fallbackDumper = in_array(PHP_SAPI, ['cli', 'phpdbg']) ? new CliDumper() : new HtmlDumper();
$dumper = new ServerDumper('tcp://127.0.0.1:9912', $fallbackDumper, [
    'cli' => new CliContextProvider(),
    'source' => new SourceContextProvider(),
]);

VarDumper::setHandler(function ($var) use ($cloner, $dumper) {
    $dumper->dump($cloner->cloneVar($var));
});
