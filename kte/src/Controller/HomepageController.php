<?php

namespace App\Controller;

use Library\Core\AbstractController;

class HomepageController extends AbstractController
{
    private $actualityManager;

    public function __construct()
    {
        $this->actualityManager = new \App\Model\Manager\ActualityManager;
    }

    public function index(): void
    {
        $this->display('Accueil', 'homepage', [
            'actuality' => $this->actualityManager->getAll(),
        ]);
    }

    public function getActualities(): array
    {
        return $this->actualityManager->getAll(); // getAll() is a static method
    }
}