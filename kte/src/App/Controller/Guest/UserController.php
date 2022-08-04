<?php

namespace App\Controller\Guest;

use Library\Core\AbstractController;

class UserController extends AbstractController
{

    public function __construct() {
        parent::__construct();
    }

    public function register(): void
    {
        if (auth()->isAuthenticated()) {
            $this->isNotIdentificatedUser();
            $this->redirect('/');
        }
        $this->display('Inscription', 'user/register');
    }

    public function create(): void
    {
        if (auth()->isAuthenticated()) {
            $this->isNotIdentificatedUser();
            $this->redirect('/');
        }
        $errors = userForm()->createUser($_POST);
        $user = $this->userManager->getUserByMail(auth()->isAuthenticated());
        if (!empty($user)) {
            flash()->addError('email', 'Un utilisateur utilise déjà cette addresse mail');
        }
        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;;
            $this->redirect('/register');
        }
        $this->userManager->insertUser([
            'society' => $_POST['society'],
            'lastname' => $_POST['lastname'],
            'firstname' => $_POST['firstname'],
            'service' => $_POST['service'],
            'address' => $_POST['address'],
            'complement' => $_POST['complement'],
            'zip' => $_POST['zip'],
            'city' => $_POST['city'],
            'email' => $_POST['email'],
            'password' => (password_hash($_POST['password'], PASSWORD_ARGON2ID)),
        ]);
        flash()->addSuccess('register', 'Vous êtes inscrit et connecté à votre espace personnel.');
        $this->auth();
        $this->redirect('/account');
    }


    public function login(): void
    {
        if (auth()->isAuthenticated()) {
            $this->isNotIdentificatedUser();
            $this->redirect('/account');
        }
        $this->display('Connexion', 'user/login');
    }

    public function auth(): void
    {
        // Récupération de l'utilisateur a partir de son email
        $user = $this->userManager->getUserByMail($_POST['email']);
        $password = '';
        if ($user === null) {
            flash()->addError('email', 'Cet utilisateur n\'existe pas');
            $this->redirect('/login');
        }
        $password = password_verify($_POST['password'], $user->getPassword());
        $errors = userForm()->authUser($user, $password);
        // S'il y a des erreurs
        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            $this->redirect('/login');
        }
        // Si tout est ok, on connecte l'utilisateur avec $_SESSION
        auth()->login($user->getId());
        flash()->addSuccess('isConnected', 'Vous venez de vous connecter.');
        if ($user->getRole_Id() === 1) {
            $_SESSION['admin'] = true;
            $this->redirect('/admin');
        }
        $this->redirect('/account');
    }


    public function account(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        }
        $this->isNotIdentificatedUser();
        $user = $this->userManager->getUserById(auth()->getUserId());
        $this->display('Mon compte', 'user/account', ['user' => $user]);
    }


    public function modify(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        }
        $this->isNotIdentificatedUser();
        $user = $this->userManager->getUserById(auth()->getUserId());
        $this->display('Modification', 'user/modify', ['user' => $user]);
    }


    public function updateUser(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        }
        $this->isNotIdentificatedUser();
        $user = $this->userManager->getUserById(auth()->getUserId());
        $errors = userForm()->modifyUser($_POST);
        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            $this->redirect('/modifyUser');
        }
        $this->userManager->updateUser([
            'id' => $user,
            'society' => $_POST['society'],
            'lastname' => $_POST['lastname'],
            'firstname' => $_POST['firstname'],
            'service' => $_POST['service'],
            'address' => $_POST['address'],
            'complement' => $_POST['complement'],
            'zip' => $_POST['zip'],
            'city' => $_POST['city'],
            'email' => $_POST['email'],
        ],
            auth()->getUserId());
        flash()->addSuccess('modifyUser', 'Modifications effectuées');
        $this->redirect('/account');
    }

    public function updatePassword(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        }
        $this->isNotIdentificatedUser();
        $user = $this->userManager->getUserById(auth()->getUserId());
        $this->display('Modification du mot de passe', 'user/updatePassword', ['user' => $user, 'post' => $_POST]);
    }

    public function updatePwd(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        }
        $this->isNotIdentificatedUser();
        $user = $this->userManager->getUserById(auth()->getUserId());
        $password = password_verify($_POST['actual_password'], $user->getPassword());
        $errors = userForm()->updatePwd($_POST, $password);
        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            $this->redirect('/updatePassword');
        }
        $this->userManager->updatePassword([
            'newPassword' => (password_hash($_POST['new_password'], PASSWORD_ARGON2ID))
        ],
        auth()->getUserId());
        flash()->addSuccess('modifyPwd', 'Votre mot de passe a été modifié');
        $this->redirect('/account');
    }

    public function deleteAccount() {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        }
        $this->isNotIdentificatedUser();
        $user = $this->userManager->getUserById(auth()->getUserId());
        $this->userManager->deleteUser($user->getId());
        auth()->logout();
        flash()->addSuccess('deleteUser', 'Vous avez supprimé votre compte.');
        $this->redirect('/');
    }

    public function logout(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        }
        $this->isNotIdentificatedUser();
        auth()->logout();
        flash()->addSuccess('logout', 'Vous êtes déconnecté.');
        $this->redirect('/');
    }
}