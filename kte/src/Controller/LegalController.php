<?php

namespace App\Controller;

class LegalController extends \Library\Core\AbstractController
{
    public function index(): void
    {
        $this->display('Mentions légales', 'legal', []);
    }
}
