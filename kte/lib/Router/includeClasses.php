<?php

function includeClasses($className)
{

    if (file_exists($fichier = 'Models/' . $className . '.php')) {
        require $fichier;
    } elseif (file_exists($fichier = 'AbstractController/' . $className . '.php')) {
        require $fichier;
    } elseif (file_exists($fichier = 'lib/Data/' . $className . '.php')) {
        require $fichier;
    } elseif (file_exists($fichier = 'lib/Router/' . $className . '.php')) {
        require $fichier;
    } elseif (file_exists($fichier = 'lib/Auth/' . $className . '.php')) {
        require $fichier;
    }
}

// On appel et on execute la function native spl_autoload_register qui prend en parametre notre function
spl_autoload_register('includeClasses');
