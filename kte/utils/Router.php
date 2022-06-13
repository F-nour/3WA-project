<?php

// namespace Config\Routing;

class Router
{
    // Listes des routes autorisées
    private const AUTHORIZED = [
        'homepage',
        'about',
        'admin',
    ];

    // Template à afficher par défault à l'ouverture du site
    public $template;

    // Méthode appelée par le routeur
    public function run(): void
    {
        if (isset($_GET['page'])) {
            $this->template = $_GET['page'];
        }
        if (!in_array($this->template, $this::AUTHORIZED)) {
            $this->template = 'e404';
        }
        $this->callController();
    }

    // Appel du controller
    public function callController(): void
    {
        switch ($this->template) {
            case (parse_url('#home')):
                $controller = new \App\Controller\Static\HomepageController();
                $controller->display();
                break;
            case (parse_url('#about')):
                $controller = new \App\Controller\Static\AboutController();
                $controller->display();
                break;
            default:
                $controller = new \App\Controller\Static\HomepageController();
                $controller->display();
                break;
        }
    }
}
