<?php

namespace App\Controller;

class ErrorController
{
    public function index()
    {
        $title = 'Erreur 404 - Page introuvable';
        $template = 'Views/Templates/Pages/error.phtml';
        require 'Views/layout.phtml';
    }
}
