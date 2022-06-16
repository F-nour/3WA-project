<?php

/**
 * @brief File for the contactController class.
 * @file ContactController.php
 */

/**
 * @brief namespace for the ContactController class.
 * @namespace App\Controller
 * @uses \Library\Core\AbstractController : AbstractController class.
 */

namespace App\Controller;

use Library\Core\AbstractController;

/**
 * @class ContactController
 * @brief ContactController class.
 * @extends AbstractController class.
 */
class ContactController extends AbstractController
{
    /**
     * @method void index : method to get the contact page.
     */
    public function index(): void
    {
        $this->display('Contact', 'contact');
    }
}