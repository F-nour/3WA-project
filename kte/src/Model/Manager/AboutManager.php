<?php

/**
 * @brief file for the AboutManager class.
 * @file AboutManager.php
 * @namespace App\Model\Manager
 * @uses \Library\Core\AbstractManager AbstractManager class.
 * @class AboutManager
 */

namespace App\Model\Manager;

use \Library\Core\AbstractManager;

class AboutManager extends AbstractManager
{

    /**
     * @biref Method to construct the AboutManager class.
     * @method void __construct
     */
    public function __construct()
    {
        parent::__construct(self::ABOUT);
    }

    /**
     * @brief Method to get data from the about table.
     * @method object getAbout
     * @return object
     */
    public function getAbout(): object
    {
        $result = $this->db->getResult(
            'SELECT society, status, city, mail FROM ' . SELF::ABOUT
        );
        return $result;
    }
}
