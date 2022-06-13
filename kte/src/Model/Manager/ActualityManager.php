<?php

namespace App\Model\Manager;

class ActualityManager extends \Library\Core\AbstractManager
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
