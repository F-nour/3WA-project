<?php

namespace App\Controller;

use Exception;
use Library\Core\AbstractController;
use App\Model\Table\User;
use App\Model\Manager\UserManager;

class UserController extends AbstractController
{
    private $manager;
    private $user;

    public function __construct()
    {
        $this->manager = new UserManager();
        $this->user = new User();
    }

    public function register(): void
    {
        if (auth()->isAuthenticated()) {
            $this->redirect('/');
        }
        $this->display('Inscription', 'user/register');
    }

    public function create(): void
    {
        if (auth()->isAuthenticated()) {
            $this->redirect('/');
        }
        $errors = userForm()->createUser($_POST);
        $user = $this->manager->getUserByMail(auth()->isAuthenticated());
        if (!empty($user)) {
            flash()->addError('username', 'Un utilisateur utilise déjà cette adresse mail');
        }
        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            $this->redirect('/register');
        }
        $this->manager->insertUser([
            'society' => $_POST['society'],
            'lastname' => $_POST['lastname'],
            'firstname' => $_POST['firstname'],
            'service' => $_POST['service'],
            'adress' => $_POST['adress'],
            'complement' => $_POST['complement'],
            'zip' => $_POST['zip'],
            'city' => $_POST['city'],
            'email' => $_POST['email'],
            'password' => (password_hash($_POST['password'], PASSWORD_ARGON2ID)),
        ]);
            $this->redirect('/');
        }


    public function login(): void
    {
        if (auth()->isAuthenticated()) {
            $this->redirect('/');
        }
        $this->display('Connexion', 'user/login');
    }

    public function auth(): void
    {
        // Récupération de l'utilisateur a partir de son email
        $user = $this->manager->getUserByMail($_POST['email']);
        $password = password_verify($_POST['password'], $user->getPassword());
        $errors = userForm()->authUser($user, $password);
        // S'il y a des erreurs
        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            $this->redirect('/login');
        }
        // Si tout est ok, on connecte l'utilisateur avec $_SESSION
            auth()->login($user->getId());
            flash()->addSuccess('isConnected', 'Vous êtes connecté');
            $this->redirect('/account');
        }

    public function account(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        } else {
            $user = $this->manager->getUserById(auth()->isAuthenticated());
            $this->display('Mon compte', 'user/account', ['user' => $user]);
        }
    }

    public function modify(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        } else {
            $user = $this->manager->getUserById(auth()->isAuthenticated());
            $this->display('Modification', 'user/modify', ['user' => $user]);
        }
    }

    public function updateUser(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        }
        $errors = userForm()->modifyUser($_POST);
        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            $this->redirect('/modify');
        }
        $this->manager->updateUser([
            'society' => $_POST['society'],
            'lastname' => $_POST['lastname'],
            'firstname' => $_POST['firstname'],
            'service' => $_POST['service'],
            'adress' => $_POST['adress'],
            'complement' => $_POST['complement'],
            'zip' => $_POST['zip'],
            'city' => $_POST['city'],
            'email' => $_POST['email'],
        ],
            auth()->isAuthenticated());
            flash()->addSuccess('modifyUser', 'Modifications effectuées');
            $this->redirect('/account');
        }



    public function updatePassword(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        } else {
            $user = $this->manager->getUserById(auth()->isAuthenticated());
            $this->display('Modification du mot de passe', 'user/updatePassword', ['user' => $user, 'post' => $_POST]);
        }
    }

    public function updatePwd(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        }
        $user = $this->manager->getUserById(auth()->isAuthenticated());
        $password = password_verify($_POST['actualPassword'], $user->getPassword());
        $errors = userForm()->updatePwd($_POST, $password);
        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            $this->redirect('/updatePassword');
        }
        $this->manager->updatePassword([
            'newPassword' => (password_hash($_POST['newPassword'], PASSWORD_ARGON2ID))
        ],
            auth()->isAuthenticated());
        flash()->addSuccess('modifyPwd', 'Votre mot de passe a été modifié');
        $this->redirect('/account');
    }

    public function logout(): void
    {
        auth()->logout();
        $this->redirect('/');
    }
}