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
        $errors = validForm()->userForm($_POST);
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
        if ($this->user->isValid()) {
            $this->redirect('/');
        } else {
            $errors = $this->user->getErrors();
            $this->redirect('/login');
        }
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
        $errors = validForm()->userForm($_POST);
        // Récupération de l'utilisateur a partir de son email
        $userbyMail = $this->manager->getUserByMail($_POST['email']);
        if (!$userbyMail) {
            flash()->addError('email', 'Adresse mail invalide');
            $this->redirect('/login');
        }
        // Vérification du mot de passe avec password_verify
        $user = $userbyMail;

        $password = password_verify($_POST['password'], $user->getPassword());
        if (!$password) {
            flash()->addError('password', 'Mot de passe invalide');
            $this->redirect('/login');
        }
        // Si tout est ok, on connecte l'utilisateur avec $_SESSION
        if (validForm()->isValid()) {
            auth()->login($user->getId());
            $this->redirect('/account');
        }
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
        } else {
            $user = $this->manager->getUserById(auth()->isAuthenticated());
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
            if ($this->user->isValid()) {
                $this->redirect('/account');
            } else {
                $_SESSION('errors');
                $this->redirect('/modify');
            }
        }
    }

    public function updatePassword(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        } else {
            $user = $this->manager->getUserById(auth()->isAuthenticated());
            $this->display('Modification du mot de passe', 'user/updatePassword', ['user' => $user]);
        }
    }

    public function updatePwd(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        } else {
            $user = $this->manager->getUserById(auth()->isAuthenticated());
            $password = password_verify($_POST['password'], $user->getPassword());
            if (!$password) {
                $user->addError(User::PASSWORD_INVALID);
            }
            $this->manager->updatePassword([
                'newPassword' => (password_hash($_POST['newPassword'], PASSWORD_ARGON2ID)),
            ],
                auth()->isAuthenticated());
            if ($_POST['newPassword'] !== $_POST['password_confirm']) {
                $_SESSION['error'] = ['password' => $this->user->addError(User::PASSWORD_INVALID)];
            }
            if ($this->user->isValid()) {
                $this->redirect('/account');
            } else {
                $_SESSION['errors'];
                $this->redirect('/updatePassword');
            }
        }
    }

    public function logout(): void
    {
        auth()->logout();
        $this->redirect('/');
    }
}