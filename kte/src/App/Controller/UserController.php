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
        $this->display('Inscription', 'users/register');
    }

    public function create(): void
    {
        if (auth()->isAuthenticated()) {
            $this->redirect('/');
        }
        if (isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['email']) && isset($_POST['password'])) {
            $this->user->createDataRow([
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
            if ($_POST['password'] !== $_POST['password_confirm']) {
                $this->user->addError(User::PASSWORD_INVALID);
            }
            if ($this->user->isValid()) {
                $this->manager->insertUser($this->user);
                $this->redirect('/login');
            } else {
                $errors = $this->user->getErrors();
            }
        }
    }

    public function login(): void
    {
        if (auth()->isAuthenticated()) {
            $this->redirect('/');
        }
        $this->display('Connexion', 'users/login');
    }

    public function auth(): void
    {
        // Récupération de l'utilisateur a partir de son email
        $userbyMail = $this->manager->getUserByMail($_POST['email']);
        // Si l'utilisateur n'existe pas, on affiche une erreur
        if (!$userbyMail) {
            $this->user->addError(User::EMAIL_INVALID);
        }
        // Vérification du mot de passe avec password_verify
        $user = $userbyMail;

        $password = password_verify($_POST['password'], $user->getPassword());

        // Si le mot de passe est invalide, on affiche une erreur
        if (!$password) {
            $user->addError(User::PASSWORD_INVALID);
        }

        // Si tout est ok, on connecte l'utilisateur avec $_SESSION
        if ($user->isValid()) {
            auth()->login($user->getId());
            $this->redirect('/');
        } else {
            $errors = $user->getErrors();
            $this->redirect('/login?errors');
        }
    }
    
    public function logout(): void
    {
        auth()->logout();
        $this->redirect('/');
    }
}