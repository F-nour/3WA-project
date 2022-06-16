<?php

/**
 * @brief File for the HomepageController class.
 * @file HomepageController.php
 * @namespace App\Controller
 * @uses \Library\Core\AbstractController : AbstractController class.
 * @class HomepageController : HomepageController class.
 * @extends AbstractController class.
 */

namespace App\Controller;

use Library\Core\AbstractController;
use App\Model\Manager\ActualityManager;

class HomepageController extends AbstractController
{
    /**
     * @property $actualityManager : ActualityManager object.
     * @method __construct : constructor method.
     */
    private $actualityManager;

    public function __construct()
    {
        $this->actualityManager = new ActualityManager;
    }

    /**
     * @brief Method to get the homepage page.
     * @method void index
     */
    public function index(): void
    {
        $this->display('Accueil', 'homepage', [
            'actuality' => $this->actualityManager->getAll(),
        ]);
    }

    /**
     * @brief Method to get all actualities.
     * @method array getAllActualities
     * @return array
     */
    public function getActualities(): array
    {
        return $this->actualityManager->getAll(); // getAll() is a static method
    }
}