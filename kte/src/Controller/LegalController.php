<?php

/**
 * @brief file for the LegalController class.
 * @file LegalController.php
 * @namespace App\Controller
 * @uses \Library\Core\AbstractController : AbstractController class.
 * @class LegalController
 */

namespace App\Controller;

use \Library\Core\AbstractController;

class LegalController extends AbstractController
{
    /**
     * @brief Method to get the legal page.
     * @method void legal
     */
    public function index(): void
    {
        $this->display('Mentions légales', 'legal', []);
    }
}
