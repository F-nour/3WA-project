<?php

namespace App\Controller\Admin;

use Library\Core\AbstractController;

class AdminController extends AbstractController
{


    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $this->isAdmin();
        $admin = $this->getAdminUser();
        $this->displayAdmin('Accueil', 'admin/index', ['admin' => $admin]);
    }

    public function getAdminUser(): ?object
    {
        $this->isAdmin();
        return $this->userManager->getUserById(auth()->getUserId());
    }

    public function updateRole()
    {
        $this->isAdmin();
        $user = $this->userManager->getUserById($_GET['id']);
        $userId = $user->getId();
        $this->userManager->updateRole([
            'role_id' => $_POST['roleId']
        ], $userId);
        flash()->addSuccess('roleId', "Le rôle de l'utilisateur a été modifié");
        $this->redirect('\admin');
    }

    public function editAbout()
    {
        $this->isAdmin();
        $about = $this->aboutManager->getAbout();
        $this->displayAdmin('Modifier les informations du site', 'admin/about/update', ['about' => $about]);
    }

    public function updateAboutForm() {
        $this->isAdmin();
        $about = $this->aboutManager->getAbout();
        $errors = aboutForm()->updateAbout($_POST);
        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            $this->redirect('/admin/editAbout');
        }
        $this->aboutManager->updateAbout([
            'society' => $_POST['society'],
            'status' => $_POST['status'],
            'INSEE' => $_POST['INSEE'],
            'zip' => $_POST['zip'],
            'city' => $_POST['city'],
            'email' => $_POST['email']
        ], $about->id);
        flash()->addSuccess('about', "Les informations du site ont été modifiées");
        $this->redirect('/admin');
    }
}