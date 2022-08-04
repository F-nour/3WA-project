<?php

/**
 * @brief file for the AboutController class.
 * @file AboutController.php
 */

/**
 * @uses \Library\Core\AbstractController : AbstractController class.
 * @uses \App\Model\Manager\AboutManager : AboutManager class.
 */

namespace App\Controller\Guest;

use Library\Core\AbstractController;

/**
 * @class AboutController
 * @brief AboutController class.
 */
class AboutController extends AbstractController
{

    public function __construct() {
        parent::__construct();
    }

    /**
     * @brief Method to get the about page.
     * @method void index
     */
    public function index(): void
    {
        $this->display('À propos', 'about', ['about' => $this->getAbout()]);
    }

    /**
     * @brief Method to get data from the about table.
     * @method void getAbout
     * @return object
     */
    private function getAbout(): object
    {
        return $this->aboutManager->getAbout();
    }
}
