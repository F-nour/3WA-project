<?php

namespace App\Model\Manager;

class ActualityManager extends \App\Model\Manager\AbstractManager
{

    public function __construct()
    {
        parent::__construct(self::ACTUALITIES);
    }

    public function getAll(): array
    {
        $result = $this->db->getResults(
            'SELECT * FROM ' . SELF::ACTUALITIES . ' ORDER BY id ASC',
        );
        return $result;
    }
}
