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


use App\Model\Table\User;
use Library\Auth\Authentifier;

/**
 * @brief abstract class for controllers.
 * @class AbstractController
 * @property string $userLayout layout
 * @property string $adminLayout administrator layout
 * @const string SITE_NAME = 'Kiff ton Écharpe' name of the site
 */
class AbstractController
{
    const SITE_NAME = 'Kiff ton Écharpe';
    protected $user;
    protected $admin;
    protected $userLayout = 'Views/layout.phtml';
    protected $adminLayout = '../Admin/admin_layout.phtml';

    public function getConnectedUser(): ?User
    {
        $auth = new Authentifier();
        $auth->startSession();
        $userIsConnected = $auth->getUser();
        if ($auth->getRole() === 'admin') {
            return $admin = $this->admin;
        } elseif ($auth->getRole() === 'user') {
            return $user = $this->user;
        }
        return $userIsConnected;
        // echo 'test'; test de la fonction getConnectedUser()
    }

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
        $template = 'Views/Templates/Pages/' . $template . '.phtml';
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
        $template = '../Admin/Views/Templates/Pages/' . $template . '.phtml';
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
