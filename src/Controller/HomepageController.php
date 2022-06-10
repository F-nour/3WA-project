<?php

namespace App\Controller;

use \App\Model\Manager\ActualityManager;

class HomepageController extends AbstractController
{
    private $actualityManager;

    public function __construct()
    {
        $this->actualityManager = new ActualityManager();
    }

    public function display(): void
    {
        $title = 'accueil';
        $connectedUser = $this->getConnectedUser();
        $actuality = $this->getActualities();
        $template = 'Views/Templates/Pages/homepage.phtml';

        require  $this->layout;
    }

    public function getActualities(): array
    {
        return $this->actualityManager->getAll(); // getAll() is a static method
    }
}