<?php

namespace App\Controller;

class LegalController extends AbstractController
{
    public function display(): void
    {
        $title = 'Mentions légales';
        $template = 'Views/Templates/Pages/legal.phtml';
        require $this->layout;
    }
}
