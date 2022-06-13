<?php

namespace App\Controller;

class AboutController
{
    public function index(): void
    {
        $title = 'À propos';
        $template = 'Views/Templates/Pages/about.phtml';
        require 'Views/layout.phtml';
    }
}
