<?php

namespace App\Controller\Guest;

use App\Model\Manager\ActualityManager;
use Library\Core\AbstractController;


/**
 * @brief File for the HomepageController class.
 * @file HomepageController.php
 * @namespace App\Controller
 * @uses \Library\Core\AbstractController : AbstractController class.
 * @class HomepageController : HomepageController class.
 * @extends AbstractController class.
 */

class HomepageController extends AbstractController
{
    /**
     * @property object $actualityManager : ActualityManager object.
     * @method __construct : constructor method.
     */
    protected object $actualityManager;

    public function __construct() {
        parent::__construct();
    }

    /**
     * @brief Method to get the homepage page.
     * @method void index
     */
    public function index(): void
    {
        $this->display('Accueil', 'homepage', [
            'actuality' => $this->getActualities(),
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