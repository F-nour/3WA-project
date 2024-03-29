<?php

/**
 * @file AbstractManager.php
 * @brief file for the AbstractManager class.
 */

/**
 * @brief namespace Library\Core
 * @namespace Library\Core
 * @uses \Library\Database\Connexion  Connexion to the database
 */

namespace Library\Core;

use Library\Database\Connexion;

/**
 * @brief abstract class for managers.
 * @class AbstractManager
 * @property Connexion $db Connexion to the database
 * @property $config array configuration file
 * names of tables in the database (for the managers) :
 * @const string ACTUALITIES = 'actualities'
 * @const string ABOUT = 'about'
 * @const string CATEGORIES = 'categories'
 * @const string CONTACT = 'contact'
 * @const string ORDERED = 'ordered'
 * @const string PRODUCTS = 'products'
 * @const string USERS = 'admin'
 *
 */
abstract class AbstractManager
{
    const ACTUALITIES = 'actualities';
    const ABOUT = 'about';
    const CATEGORIES = 'categories';
    const CONTACT = 'contacts';
    const ORDERED = 'ordered';
    const PRODUCTS = 'products';
    const ROLE = 'role';
    const USERS = 'users';
    protected Connexion $db;
    protected string $config = '../src/config/database_3wa.php';
    protected object $table;

    /**
     * @brief constructor
     * @method __construct()
     * @variable $config array configuration file
     */
    public function __construct()
    {
        $config = require $this->config;
        $this->db = new Connexion($config);
    }
}
