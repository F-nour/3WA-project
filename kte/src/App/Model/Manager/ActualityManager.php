<?php

/**
 * @brief file for the ActualityManager class.
 * @file ActualityManager.php
 * @namespace App\Model\Manager
 * @uses \Library\Core\AbstractManager : AbstractManager class.
 * @class ActualityManager
 */

namespace App\Model\Manager;

use Library\Core\AbstractManager;
use App\Model\Table\Actualities;

class ActualityManager extends AbstractManager
{

    /**
     * @brief Method to construct the ActualityManager class.
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(self::ACTUALITIES);
        $this->table = new Actualities();
    }

    /**
     * @brief Method to get all actualities.
     * @method array getAll
     * @return array
     */
    public function getAll(): array
    {
        $result = $this->db->getResults(
            'SELECT id, title, content, img, date FROM ' . SELF::ACTUALITIES . ' ORDER BY id ASC',
        );
        return $result;
    }

    public function getActualityById(int $id): ?Actualities
    {
        $actualityById = $this->db->getResult(
            'SELECT id, title, content, img, date FROM ' . SELF::ACTUALITIES . ' WHERE id = :id',
            [
                'id' => $id
            ]
        );
        if ($actualityById === null) {
            return null;
        }

        $this->table->createDataRow((array) $actualityById);
        return $this->table;
    }

    public function create(string $title, string $content, string $img): ?int
    {
        $newActu = $this->db->execute(
            'INSERT INTO ' . SELF::ACTUALITIES . ' (title, content, img, date) VALUES (:title, :content, :img, now())',
            [
                'title' => $title,
                'content' => $content,
                'img' => $img,
            ]
        );

        if ($newActu === false) {
            return null;
        }

        return $newActu;
    }

    public function updateActuality(array $data, int $id): ?int
    {
        $updateActu = $this->db->execute(
            'UPDATE ' . SELF::ACTUALITIES . ' SET title = :title, content = :content, img = :img WHERE id = :id',
            [
                'title' => $data['title'],
                'content' => $data['content'],
                'img' => $data['img'],
                'id' => $id,
            ]
        );

        if ($updateActu === false) {
            return null;
        }

        return $updateActu;
    }
}
