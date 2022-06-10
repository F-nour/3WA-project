<?php

namespace App\Model\Manager;

class UserManager extends AbstractManager
{

    public function __construct()
    {
        parent::__construct(self::USERS);
    }

    public function getAllUsers() : array
    {
        $sql = 'SELECT id, role, society, INSEE, lastname, firstname, tel, service, adress, complement, zip, city, email  FROM ' . self::USERS;
        $result = $this->db->query->prepare($sql);
        $result->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, \App\Model\Table\User::class);
        $users = $result->fetchAll();
        return $users;
    }

    public function getUserById(int $id) : \App\Model\Table\User
    {
        $sql = 'SELECT id, role, society, INSEE, lastname, firstname, tel, service, adress, complement, zip, city, email  FROM ' . self::USERS . ' WHERE id = :id';
        $result = $this->db->query->prepare($sql);
        $result->bindValue(':id', $id, \PDO::PARAM_INT);
        $result->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, \App\Model\Table\User::class);
        $user = $result->fetch();
        return $user;
    }






}