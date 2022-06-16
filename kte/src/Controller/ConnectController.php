<?php

/**
 * @brief File for the ConnectController class.
 * @file ConnectController.php
 */

/**
 * @namespace App\Controller
 * @uses \Library\Core\AbstractController : AbstractController class.
 */
namespace App\Controller;

use \Library\Core\AbstractController;

class ConnectController extends AbstractController
{
    /**
     * @brief method to get the connect page.
     * @method void index
     */
    public function index(): void
    {
        $this->display('Connexion', 'connect');
    }
}