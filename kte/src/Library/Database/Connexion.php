<?php

/**
 * @file Connexion.php
 * @brief file for the Connexion class.
 */

/**
 * @brief namespace pour la classe Connexion.
 * @namespace Library\Database
 */

namespace Library\Database;

/**
 * @brief Use PDO to connect to the database.
 * @uses PDO.
 */

use \PDO;
use \PDOException;

/**
 * @brief Connexion class
 * @class Connexion
 * @property PDO $db Connexion to the database
 */
class Connexion
{
    protected PDO $pdo;

    /**
     * @brief constructor
     * @method __construct()
     * @param array $config configuration file
     */
    public function __construct(array $config)
    {
        $this->pdo = new PDO(
            "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=UTF8",
            $config['db_user'],
            $config['db_password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
                PDO::MYSQL_ATTR_FOUND_ROWS => true,
            ]
        );
    }

    /**
     * @brief Method to get the PDO object.
     * @method getPDO() : PDO
     * @return PDO $pdo
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    /**
     * @brief Method to get several rows from a table.
     * @method getResults() : array
     * @param string $sql SQL query
     * @param array $params parameters of the query
     */
    public function getResults(
        string $sql,
        ?array $parameters = null
    ): array {
        try {
            $query = $this->pdo->prepare($sql);
            $query->execute($parameters);
            return $query->fetchAll();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @brief Method to get a row from a table.
     * @method getResult() : object
     * @param string $sql SQL query
     * @param array $params parameters of the query
     */
    public function getResult(
        string $sql,
        ?array $parameters = null,
    ): ?object {
        try {
            $query = $this->pdo->prepare($sql);
            $query->execute($parameters);

            return $query->fetch();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @brief Method to insert, update or delate a row in a table.
     * @method execute()
     * @param string $sql SQL query
     * @param array $parameters parameters of the query
     */
    public function execute(
        string $sql,
        ?array $parameters = null
    ): string|false
    {
        try {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
