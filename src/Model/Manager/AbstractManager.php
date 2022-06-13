<?php

namespace App\Model\Manager;

use \Library\Database\Connection;

abstract class AbstractManager
{
    protected $db;
    protected $config = '../lib/Database/config_3wa.php';

    const ACTUALITIES = 'actualities';
    const ABOUT = 'about';
    const CATEGORIES = 'categories';
    const CONTACT = 'contacts';
    const ORDERED = 'ordered';
    const PRODUCTS = 'products';
    const USERS = 'users';

    public function __construct()
    {
        $config = require $this->config;
        $this->db = new Connection($config);
        // $this->db = new Connection();
    }
}
