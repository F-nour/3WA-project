<?php

namespace Library\Auth;

use App\Model\Manager\UserManager;

class Authentifier
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login(int $id): void
    {
        $_SESSION['user_id'] = $id;
    }

    public function logout(): void
    {
        unset($_SESSION['user_id']);
        session_destroy();
    }

    public function isAuthenticated(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public function isAdmin(): bool
    {
        $userManager = new UserManager();
        $user = $userManager->getUserByRole($_SESSION['user_id']);
        if ($user->getRole() === 1) {
            return true;
        } else {
            return false;
        }
    }
}
