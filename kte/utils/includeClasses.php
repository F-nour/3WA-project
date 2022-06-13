<?php

function includeClasses($className)
{

    if (file_exists($file = 'src/Models/' . $className . '.php')) {
        require $file;
    }
}

spl_autoload_register('includeClasses');
