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

use App\Model\Manager\AboutManager;
use App\Model\Manager\ActualityManager;
use App\Model\Manager\ProductManager;
use App\Model\Manager\UserManager;
use App\Model\Table\About;
use App\Model\Table\Actualities;
use App\Model\Table\Product;
use App\Model\Table\User;

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

    protected string $layout = '../src/App/Views/layout.phtml';
    protected string $template = 'Templates/Pages/';

    protected object $actualityManager;
    protected object $productManager;
    protected object $product;
    protected object $userManager;
    protected object $user;
    protected object $aboutManager;
    protected object $about;
    protected object $actualites;

    public function __construct()
    {
        $this->aboutManager = new AboutManager();
        $this->about = new About();
        $this->actualityManager = new ActualityManager;
        $this->actualites = new Actualities();
        $this->productManager = new ProductManager();
        $this->product = new Product();
        $this->userManager = new UserManager();
        $this->user = new User();
    }
    /**
     * @brief It takes a title, a template, and an optional array of data, and then displays the template with the data
     *
     * @method display
     *
     * @param string $title The title of the page
     * @param string $template The name of the template file to be displayed.
     * @param array|null $data an array of data to be passed to the view
     */
    public function display(string $title, string $template, ?array $data = []): void
    {
        extract($data);
        $title = SELF::SITE_NAME . ' - ' . $title;
        $alert = flash()->display();
        $view = $this->displayIdRoute();
        $name = $this->getName($title);
        $template = $this->template . $template . '.phtml';
        require $this->layout;
    }

    /**
     * @brief method displays the admin template
     *
     * @method displayAdmin
     *
     * @param string title: The title of the page
     * @param string template: the name of the template to be displayed
     * @param array|null data: an array of data to be extracted and used in the view.
     */
    public function displayAdmin(string $title, string $template, ?array $data = []): void
    {
        extract($data);
        $title = SELF::SITE_NAME . ' - Espace administrateur - ' . $title;
        $template = $this->template . $template . '.phtml';
        $alert = flash()->display();
        $view = $this->displayIdRoute();
        $name = $this->getName($title);
        require $this->layout;
    }

    /**
     * @brief It redirects the user to a new page
     *
     * @method redirect
     *
     * @param string path The path to redirect to.
     */
    public function redirect(string $path): void
    {
        header('Location: ' . url($path));
        exit();
    }

    /**
     * @brief It creates an actuality
     *
     * @method createActuality
     *
     * @param string title The title of the actuality
     * @param string content The content of the actuality
     * @param string|null img The image of the actuality.
     * @param string|null titleImg The title of image
     *
     * @return ?int The id of the created actuality.
     */
    public function createActuality(string $title, string $content, ?string $img, ?string $titleImg): ?int
    {
        $actualityManager = new ActualityManager();
        return $actualityManager->create($title, $content, $img, $titleImg);
    }

    /**
     * @brief It returns the name of the current route.
     *
     * @method displayIdRoute
     *
     * @return string The name of the route.
     */
    private function displayIdRoute(): string
    {
        $route = $_SERVER['REQUEST_URI'] ?? url('/');
        $site = strlen('/kte/');
        $nameRoute = substr($route, $site);
        if (!empty($nameRoute)) {
            return str_replace('/', '', $nameRoute);
        }
        return 'home';
    }

    /**
     * @brief It takes a string, checks if it starts with a certain string, and if it does, it returns the string without that part
     *
     * @method getName
     *
     * @param string title The title of the page.
     *
     * @return string The name of the page.
     */
    private function getName(string $title): string
    {
        if (SELF::SITE_NAME . ' - ') {
            return substr($title, strlen(SELF::SITE_NAME . ' - '));
        } else {
            return $title;
        }
    }

    protected function isNotIdentificatedUser(): void {
        if (auth()->isAuthenticated()) {
            $sessionId = $_SESSION['user_id'];
            $user = $this->userManager->getUserById($sessionId);
            if ($user === null) {
                auth()->logout();
                flash()->addGlobalError('not_user', "Vous n'avez pas de compte utilisateur");
                $this->redirect('/');
            }
        }
    }

    protected function isAdmin () {
        if (!auth()->isAdmin()) {
            flash()->addGlobalError('admin', "Vous n'êtes pas autorisé à aller sur cette page");
            $this->redirect('/login');
        }
        $this->isNotIdentificatedUser();
    }
}
