<?php

namespace App\Controller;

use \Library\Auth\Authentifier;

class AbstractController
{
    protected $user; // 1 = admin, 2 = user
    protected $admin;
    protected $userLayout = 'Views/layout.phtml';
    protected $adminLayout = '../Admin/admin_layout.phtml';

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
}
