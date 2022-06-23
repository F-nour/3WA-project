<?php

/**
 * @file AbstractController.php
 * @brief Fichier de classe abstraite pour les contrôleurs.
 */

/**
 * @namespace Library\Core
 * @uses \Library\Auth\Authentifier
 */

namespace Library\Core;


/**
 * @brief abstract class for controllers.
 * @class AbstractController
 * @property string $userLayout layout
 * @property string $adminLayout administrator layout
 * @const string SITE_NAME = 'Kiff ton Écharpe' name of the site
 */
abstract class AbstractController
{
    const SITE_NAME = 'Kiff ton Écharpe';
    protected $userLayout = '../src/App/Views/layout.phtml';
    protected $adminLayout = '../admin/admin_layout.phtml';

    /**
     * @brief display method
     * @method display(string $title, string $template, ?array $data = null) Rendu de la vue.
     * @param string $title : page title
     * @param string $template : template file
     * @param ?array $data : data to display
     * @return void
     */

    private function purify($html) {
        $config = \HTMLPurifier_Config::createDefault();
        $purifier = new \HTMLPurifier($config);
        $clean_html = $purifier->purify($html);
        return $clean_html;
    }
    public function display(string $title, string $template, ?array $data = []): void
    {
        extract($data);
        $title = SELF::SITE_NAME . ' - ' . $title;
        $template = '../src/App/Views/Templates/Pages/' . $template . '.phtml';
        $this->purify($this->userLayout);
        require $this->userLayout;
    }

    /**
     * @brief displayAdmin method
     * @method displayAdmin(string $title, string $template, ?array $data = null) Rendu de la vue dans l'espace d'administration.
     * @param string $title : page title
     * @param string $template : template file
     * @param ?array $data : data to display
     * @return void
     */
    public function displayAdmin($title, $template, ?array $data = [])
    {
        extract($data);
        $title = SELF::SITE_NAME . ' - Espace administrateur - ' . $title;
        $template = '../src/Views/Templates/Admin/' . $template . '.phtml';
        require $this->adminLayout;
    }

    /**
     * @brief redirect method
     * @method redirect(string $path) : redirect to the given path.
     * @function url(string $path) : return an absolute URL.
     * @param string $path : path to redirect to.
     *
     */
    public function redirect(string $path): void
    {
        header('Location: ' . url($path));
        exit();
    }
}
