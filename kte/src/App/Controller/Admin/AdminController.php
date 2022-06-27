<?php

namespace App\Controller\Admin;

use App\Model\Manager\UserManager;
use Library\Core\AbstractController;

class AdminController extends AbstractController
{

    private $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function index(): void
    {
        if (auth()->isAdmin()) {
            $this->displayAdmin('', 'admin/index');
        } else {
            $this->redirect('/login');
        }
    }

    public function updateRole()
    {
        if (!auth()->isAdmin()) {
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
        if (!auth()->isAdmin()) {
            $this->redirect('/login');
        }
        $user = $this->userManager->getUserById($_GET['id']);
        $userId = $user->getId();
        $this->userManager->delateUser($userId);
        flash()->addSuccess('delateUser', "L'utilisateur a été supprimé");
        $this->redirect('/admin/user');
    }
}