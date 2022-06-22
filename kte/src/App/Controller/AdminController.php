<?php

namespace App\Controller;

use \Library\Core\AbstractController;


class AdminController extends AbstractController
{
    public function index() : void
    {
        if (auth()->isAuthenticated()) {
            $this->display('Espace Administrateur', 'admin/admin');
        } else {
            $this->redirect('/login');
        }
    }
}