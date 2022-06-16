<?php

/**
 * @brief file for the ActualityManager class.
 * @file ActualityManager.php
 * @namespace App\Model\Manager
 * @uses \Library\Core\AbstractManager : AbstractManager class.
 * @class ActualityManager
 */

namespace App\Model\Manager;

use \Library\Core\AbstractManager;

class ActualityManager extends AbstractManager
{

    /**
     * @brief Method to construct the ActualityManager class.
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(self::ACTUALITIES);
    }

    /**
     * @brief Method to get all actualities.
     * @method array getAll
     * @return array
     */
    public function getAll(): array
    {
        $result = $this->db->getResults(
            'SELECT title, content, date FROM ' . SELF::ACTUALITIES . ' ORDER BY id ASC',
        );
        return $result;
    }
}
