<?php

namespace Library\Core;

use Library\Auth\Authentifier;

class AbstractController
{
    protected $user; // 1 = admin, 2 = user
    protected $admin;
    protected $userLayout = 'Views/layout.phtml';
    protected $adminLayout = '../Admin/admin_layout.phtml';

    const SITE_NAME = 'Kiff ton Écharpe';

    protected function getConnectedUser(): ?\App\Model\Table\User
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

    public function display(string $title, string $template, ?array $data = null)
    {
        extract($data);
        $title = SELF::SITE_NAME . ' - ' . $title;
        $template = 'Views/Templates/Pages/' . $template . '.phtml';
        require $this->userLayout;
    }

    public function displayAdmin($title, $template, array $data = [])
    {
        extract($data);
        $title = SELF::SITE_NAME . ' - Espace administrateur - ' . $title;
        $template = '../Admin/Views/Templates/Pages/' . $template . '.phtml';
        require $this->adminLayout;
    }
}
