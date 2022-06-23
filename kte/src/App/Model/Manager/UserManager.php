<?php

/**
 * @brief file for the UserManager class.
 * @file UserController.php
 * @namespace App\Model\Manager
 * @uses \Library\Core\AbstractManager AbstractManager class.
 * @class UserManager
 */

namespace App\Model\Manager;

use App\Model\Table\User;
use Library\Core\AbstractManager;

class UserManager extends AbstractManager
{

    public function __construct()
    {
        parent::__construct(self::USERS);
        $this->table = new User();
    }

    /**
     * @brief Method to get all admin.
     * @method array getAll
     * @return array
     */
    public function getAllUsers(): array
    {
        $users = $this->db->getResults(
            'SELECT id, role_id, INSEE, lastname, firstname, service, adress, complement, zip, city, email, role_id 
                FROM ' . SELF::USERS . ' u 
                INNER JOIN ' . SELF::ROLE . ' r ON u.role_id = r.id
                ORDER BY id ASC'
        );
        return $users;
    }

    /**
     * @brief Method to get a user.
     * @method object getUser
     * @param int $id
     * @return object
     */
    public function getUserById(int $id): ?User
    {
        $userById = $this->db->getResult(
            'SELECT u.id, society, lastname, firstname, service, adress, complement, zip, city, email, password, r.role 
            FROM ' . self::USERS . ' u 
            INNER JOIN ' . SELF::ROLE . ' r ON u.role_id = r.id
            WHERE u.id = :id',
            [
                'id' => $id
            ]
        );
        if ($userById === null) {
            return null;
        }
            $this->table->createDataRow((array) $userById);
            return $this->table;
    }

    public function getUserByMail(string $email): ?User
    {
        $userByMail = $this->db->getResult(
            'SELECT u.id, society, lastname, firstname, service, adress, complement, zip, city, email, password, role 
            FROM ' . SELF::USERS . ' u 
            INNER JOIN ' . SELF::ROLE . ' r ON u.role_id = r.id
            WHERE email = :email',
            [
                'email' => $email
            ]
        );

        if ($userByMail === null) {
            return null;
        }
        $this->table->createDataRow((array) $userByMail);
        return $this->table;
    }

    public function getUserByRole(int $id): ?User
    {
        $userByRole = $this->db->getResult(
            'SELECT u.id, u.role_id, society, lastname, firstname, service, adress, complement, zip, city, email, password, r.role 
            FROM ' . self::USERS . ' u 
            INNER JOIN ' . SELF::ROLE . ' r ON u.role_id = r.id
            WHERE u.id = :id',
            [
                'id' => $id
            ]
        );
        if ($userByRole === null) {
            return null;
        }
        $this->table->createDataRow((array) $userByRole);
        return $this->table;
    }

    public function insertUser(array $data): ?int
    {
        $userId = $this->db->execute(
            'INSERT INTO ' . self::USERS . ' (society, lastname, firstname, service, adress, complement, zip, city, email, password)
            VALUE (:society, :lastname, :firstname, :service, :adress, :complement, :zip, :city, :email, :password)',
            [
                'id' => $id,
                'society' => $data['society'],
                'lastname' => $data['lastname'],
                'firstname' => $data['firstname'],
                'service' => $data['service'],
                'adress' => $data['adress'],
                'complement' => $data['complement'],
                'zip' => $data['zip'],
                'city' => $data['city'],
                'email' => $data['email'],
                'password' => $data['password']
            ]);
        if ($userId === null) {
            return null;
        }
        return $userId;
    }

    public function updateUser(array $data, int $id): ?int
    {
        $userId = $this->db->execute(
            'UPDATE ' . self::USERS .
            ' SET society = :society, lastname = :lastname, firstname = :firstname, service = :service, adress = :adress, complement = :complement, zip = :zip, city = :city, email = :email 
            WHERE id = :id',
            [
                'id' => $id,
                'society' => $data['society'],
                'lastname' => $data['lastname'],
                'firstname' => $data['firstname'],
                'service' => $data['service'],
                'adress' => $data['adress'],
                'complement' => $data['complement'],
                'zip' => $data['zip'],
                'city' => $data['city'],
                'email' => $data['email'],
            ]
        );
        if ($userId === false) {
            return null;
        }
        return $userId;
    }

    public function updatePassword(array $data, int $id): ?int {
        $userId = $this->db->execute(
            'UPDATE ' . self::USERS .
            ' SET password = :password  
            WHERE id = :id',
            [
                'id' => $id,
                'password' => $data['newPassword']
            ]
        );
        if ($userId === false) {
            return null;
        }
        return $userId;
    }

    public function updateRole(array $data, int $id): ?int {
        $userId = $this->db->execute(
            'UPDATE ' . self::USERS .
            ' SET role_id = :role_id  
            WHERE id = :id',
            [
                'id' => $id,
                'role_id' => $data['roleId']
            ]
        );
        if ($userId === false) {
            return null;
        }
        return $userId;
    }

    public function delateUser(int $id): ?int
    {
        $userId = $this->db->execute(
            'DELETE FROM ' . self::USERS . ' WHERE id = :id',
            [
                'id' => $id
            ]
        );
        if ($userId === false) {
            return null;
        }
        return $userId;
    }
}