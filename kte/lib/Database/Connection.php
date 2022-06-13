<?php

namespace Library\Database;

use PDO;


class Connection
{
    protected PDO $pdo;

    public function __construct(array $config)
    {
        $this->pdo = new PDO(
            "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=UTF8",
            $config['db_user'],
            $config['db_password'],
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    /**
     * Renvoie un tableau de résultats d'une requête SQL (SELECT)
     *
     */
    public function getResults(
        string $sql,
        ?array $parameters = null
    ): array {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);

        return $query->fetchAll();
    }

    /**
     * Exécute une requête SQL (INSERT, UPDATE, DELETE)
     *
     */
    public function execute(string $sql, ?array $parameters = null): string|false
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);

        return $this->pdo->lastInsertId();
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    public function setPdo(PDO $pdo): void
    {
        $this->pdo = $pdo;
    }
}
