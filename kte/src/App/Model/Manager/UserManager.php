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
    }

    /**
     * @brief Method to get all users.
     * @method array getAll
     * @return array
     */
    public function getAllUsers(): array
    {
        $users = $this->db->getResults(
            'SELECT id, role_id, INSEE, lastname, firstname, service, adress, complement, zip, city, email, role 
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
            'SELECT id, role_id, society, lastname, firstname, service, adress, complement, zip, city, email, role 
            FROM ' . self::USERS . ' u 
            INNER JOIN ' . SELF::ROLE . ' r ON u.role_id = r.id
            WHERE id = :id',
            [
                'id' => $id
            ]
        );
        return $userById;
    }

    public function getUserByMail(string $email): ?array
    {
        $userByMail = $this->db->getResult(
            'SELECT society, lastname, firstname, service, adress, complement, zip, city, email, role 
            FROM ' . self::USERS . ' u 
            INNER JOIN ' . SELF::ROLE . ' r ON u.role_id = r.id
            WHERE email = :email',
            [
                'email' => $email
            ]
        );
        exit($userByMail);
        return $userByMail;
    }

    public function getUserByRole(int $id)
    {
        $userRole = $this->db->getResult(
            'SELECT role_id role FROM ' . SELF::USERS . ' u 
            INNER JOIN ' . SELF::ROLE . ' r ON u.role_id = role.id 
            WHERE id = :id',
            [
                'id' => $id
            ]
        );
    }

    public function createUser(array $data): ?int
    {
        $userId = $this->db->execute(
            'INSERT INTO society, lastname, firstname, service, adress, complement, zip, city, email, password 
            VALUE  :society, :INSEE, :lastname, :firstname, :service, :adress, :complement, :zip, :city, :email, :password 
            ',
            [
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
            ]
        );
        if ($userId === false) {
            return null;
        }
        return $userId;
    }

    public function insertUser(User $User): string
    {
        $userId = $this->db->execute(
            'INSERT INTO ' . self::USERS . ' (society, lastname, firstname, service, adress, complement, zip, city, email, password)
            VALUE (:society, :lastname, :firstname, :service, :adress, :complement, :zip, :city, :email, :password)',
            [
                'society' => $User->getSociety(),
                'lastname' => $User->getLastname(),
                'firstname' => $User->getFirstname(),
                'service' => $User->getService(),
                'adress' => $User->getAdress(),
                'complement' => $User->getComplement(),
                'zip' => $User->getZip(),
                'city' => $User->getCity(),
                'email' => $User->getEmail(),
                'password' => $User->getPassword()
            ]
        );
        return $userId;
    }

    public function authUser(Uer $uer): ?int
    {
        $userId = $this->db->getResult(
            'SELECT id FROM ' . self::USERS . ' WHERE email = :email AND password = :password',
            [
                'email' => $uer->getEmail(),
                'password' => $uer->getPassword()
            ]
        );
        return $userId;
    }
}