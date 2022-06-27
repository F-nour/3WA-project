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

use App\Model\Manager\ActualityManager;

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
    protected $layout = '../src/App/Views/layout.phtml';
    protected $template = 'Templates/Pages/';


    /**
     * @brief display method
     * @method display(string $title, string $template, ?array $data = null) Rendu de la vue.
     * @param string $title : page title
     * @param string $template : template file
     * @param ?array $data : data to display
     * @return void
     */

    public function display(string $title, string $template, ?array $data = []): void
    {
        extract($data);
        $title = SELF::SITE_NAME . ' - ' . $title;
        $template = $this->template  . $template . '.phtml';
        require $this->layout;
    }

    /**
     * @brief displayAdmin method
     * @method displayAdmin(string $title, string $template, ?array $data = null) Rendu de la vue dans l'espace d'administration.
     * @param string $title : page title
     * @param string $template : template file
     * @param ?array $data : data to display
     * @return void
     */
    public function displayAdmin(string $title, string $template, ?array $data = []): void
    {
        extract($data);
        $title = SELF::SITE_NAME . ' - Espace administrateur - ' . $title;
        $template = $this->template . $template . '.phtml';
        require $this->layout;
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

    public function purify($html): string
    {
        $config = \HTMLPurifier_Config::createDefault();
        $purifier = new \HTMLPurifier($config);
        $clean_html = $purifier->purify($html);
        return $clean_html;
    }

    public function createActuality(string $title, string $content, ?string $img): ?int
    {
        $actualityManager = new ActualityManager();
        return $actualityManager->create($title, $content, $img);
    }
}

