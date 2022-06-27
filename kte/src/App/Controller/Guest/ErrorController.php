<?php

/**
 * @brief File for the ErrorController class.
 * @file ErrorController.php
 * @namespace App\Controller
 * @uses \Library\Core\AbstractController : AbstractController class.
 * @class ErrorController
 */

namespace App\Controller\Guest;

use Library\Core\AbstractController;

class ErrorController extends AbstractController
{

    /**
     * @brief Method to get the notFound page.
     * @method void notFound
     */
    public function notFound()
    {
        $this->display('Erreur 404 - Page introuvable', 'error/notFound');
    }

    /**
     * @brief Method to get the forbidden page.
     * @method void forbidden
     */
    public function forbidden()
    {
        $this->display('Erreur 500 - Erreur interne', 'error/internalError');
    }
}
