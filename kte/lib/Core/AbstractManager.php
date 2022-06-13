<?php

namespace Library\Core;

abstract class AbstractManager
{
    protected $db;
    protected $config = '../config/database_3wa.php';

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
        $this->db = new \Library\Database\Connection($config);
        // $this->db = new Connection();
    }
}
