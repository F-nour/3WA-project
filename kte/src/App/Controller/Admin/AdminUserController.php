<?php

namespace App\Controller\Admin;

use App\Controller\Guest\UserController;

class AdminUserController extends UserController
{

    public function index(): void
    {
        if (auth()->isAdmin()) {
            $this->display('Espace Administrateur', 'admin/user/showUser', ['user' => $this->userManager->getAllUsers()]);
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
        $this->redirect('/admin/user');
    }

    public function deleteUser()
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