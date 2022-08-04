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
        $user = $this->userManager->getUserByMail(auth()->isAuthenticated());
        if (!empty($user)) {
            flash()->addError('email', 'Un utilisateur utilise déjà cette addresse mail');
        }
        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;;
            dd($_SESSION);
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
        flash()->addSuccess('register', 'Vous êtes inscrit. Vous pouvez vous connecter');
        $this->redirect('/login');
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
        $user = $this->userManager->getUserByMail($_POST['email']);
        $password = '';
        if ($user === null) {
            $_SESSION['error'] = 'email';
        } else {
            $password = password_verify($_POST['password'], $user->getPassword());
        }
        $errors = userForm()->authUser($user, $password);
        // S'il y a des erreurs
        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            $this->redirect('/login');
        }
        // Si tout est ok, on connecte l'utilisateur avec $_SESSION
        auth()->login($user->getId());
        flash()->addSuccess('isConnected', 'Vous venez de vous connecter.');
        if ($user->getRole_id() === 1) {
            $_SESSION['admin'] = true;
            $this->redirect('/admin');
        }
        $this->redirect('/account');
    }


    public
    function account(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        } else {
            $user = $this->userManager->getUserById(auth()->isAuthenticated());
            $this->display('Mon compte', 'user/account', ['user' => $user]);
        }
    }

    public
    function modify(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        } else {
            $user = $this->userManager->getUserById(auth()->isAuthenticated());
            $this->display('Modification', 'user/modify', ['user' => $user]);
        }
    }

    public
    function updateUser(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        }
        $user = $this->userManager->getUserById(auth()->isAuthenticated());
        $errors = userForm()->modifyUser($_POST);
        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            dump($errors);
            $this->redirect('/modify');
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
            auth()->isAuthenticated());
        flash()->addSuccess('modifyUser', 'Modifications effectuées');
        $this->redirect('/account');
    }


    public
    function updatePassword(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        } else {
            $user = $this->userManager->getUserById(auth()->isAuthenticated());
            $this->display('Modification du mot de passe', 'user/updatePassword', ['user' => $user, 'post' => $_POST]);
        }
    }

    public
    function updatePwd(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        }
        $user = $this->userManager->getUserById(auth()->isAuthenticated());
        $password = password_verify($_POST['actual_password'], $user->getPassword());
        $errors = userForm()->updatePwd($_POST, $password);
        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            $this->redirect('/updatePassword');
        }
        $this->userManager->updatePassword([
            'newPassword' => (password_hash($_POST['new_password'], PASSWORD_ARGON2ID))
        ],
            auth()->isAuthenticated());
        flash()->addSuccess('modifyPwd', 'Votre mot de passe a été modifié');
        $this->redirect('/account');
    }

    public
    function logout(): void
    {
        auth()->logout();
        flash()->addSuccess('logout', 'Vous êtes déconnecté. Vous pouvez vous reconnecter si vous le souhaitez. Sinon, à très bientôt !');
        $this->redirect('/');
    }
}