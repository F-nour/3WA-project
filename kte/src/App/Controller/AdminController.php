<?php

namespace App\Controller;

use \Library\Core\AbstractController;
use \App\Model\Manager\UserManager;

class AdminController extends AbstractController
{

    private $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function index(): void
    {
        if (auth()->isAuthenticated()) {
            $this->display('Espace Administrateur', 'admin/admin');
        } else {
            $this->redirect('/login');
        }
    }

    public function updateRole()
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        }
        $user = $this->userManager->getUserById($_GET['id']);
        $userId = $user->getId();
        $this->userManager->updateRole([
            'role_id' => $_POST['roleId']
        ], $userId);
        flash()->addSuccess('roleId', "Le rôle de l'utilisateur a été modifié");
        $this->redirect('\admin');
    }

    public function delateUser()
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        }
        $user = $this->userManager->getUserById($_GET['id']);
        $userId = $user->getId();
        $this->userManager->delateUser($userId);
        flash()->addSuccess('delateUser', "L'utilisateur a été supprimé");
        $this->redirect('\admin');
    }
}