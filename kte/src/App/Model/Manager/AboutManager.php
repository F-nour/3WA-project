<?php

/**
 * @brief file for the AboutManager class.
 * @file AboutManager.php
 * @namespace App\Model\Manager
 * @uses \Library\Core\AbstractManager AbstractManager class.
 * @class AboutManager
 */

namespace App\Model\Manager;

use Library\Core\AbstractManager;

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
        return $this->db->getResult(
            'SELECT id, society, status, INSEE, zip, city, mail, image, titleImage FROM ' . SELF::ABOUT
        );
    }

    public function updateAbout(array $data, int $id): ?int
    {
            $aboutId = $this->db->execute(
            'UPDATE ' . SELF::ABOUT .
            ' SET society = :society, status = :status, INSEE = :INSEE, zip = :zip, city = :city, mail = :mail 
            WHERE id = :id',
            [
                'society' => $data['society'],
                'status' => $data['status'],
                'INSEE' => $data['INSEE'],
                'zip' => $data['zip'],
                'city' => $data['city'],
                'mail' => $data['email'],
                'id' => $id
            ]
        );
        if ($aboutId === false) {
            return null;
        }
        return $aboutId;
    }
}
