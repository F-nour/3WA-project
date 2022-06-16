<?php

/**
 * @brief file for the UserManager class.
 * @file UserManager.php
 * @namespace App\Model\Manager
 * @uses \Library\Core\AbstractManager AbstractManager class.
 * @class UserManager
 */

namespace App\Model\Manager;

use App\Model\Table\User;
use Library\Core\AbstractManager;
use PDO;

class UserManager extends AbstractManager
{

    public function __construct()
    {
        parent::__construct(self::USERS);
    }

    /**
     * @brief Method to get all users.
     * @method array getAll
     * @return array
     */
    public function getAllUsers(): array
    {
        $sql = 'SELECT id, role, society, INSEE, lastname, firstname, tel, service, adress, complement, zip, city, email  FROM ' . self::USERS;
        $result = $this->db->query->prepare($sql);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, User::class);
        $users = $result->fetchAll();
        return $users;
    }

    /**
     * @brief Method to get a user.
     * @method object getUser
     * @param int $id
     * @return object
     */
    public function getUserById(int $id): User
    {
        $sql = 'SELECT id, role, society, INSEE, lastname, firstname, tel, service, adress, complement, zip, city, email  FROM ' . self::USERS . ' WHERE id = :id';
        $result = $this->db->query->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, User::class);
        $user = $result->fetch();
        return $user;
    }
}