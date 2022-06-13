<?php

$autoload = '../../vendor/autoload.php';

require $autoload; // On appelle le fichier autoload.php

$controller = new \App\Controller\HomepageController; // On appelle la classe HomepageController
$controller->display(); // On appelle la méthode display() de la classe HomepageController
