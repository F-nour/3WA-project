<?php

namespace Library\Auth;

use App\Model\Manager\UserManager;
use App\Model\Table\User;

class Authentifier
{
    public function startSession(): void
    {
        session_start();
    }

    public function login(int $userId): void
    {
        $_SESSION['user_id'] = $userId;
    }

    public function logout(): void
    {
        unset($_SESSION['user_id']);
        session_destroy();
    }

    public function getUser(): ?User
    {
        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        $manager = new UserManager();
        $user = $manager->getUserById($_SESSION['user_id']);
        $this->getRole();
        return $user;
    }

    public function getRole(): ?string
    {
        if (!isset($_SESSION['user_id'])) {
            return null;
        } elseif ($this->getUser()->getRole() === 1) {
            return 'admin';
        } elseif ($this->getUser()->getRole() === 2) {
            return 'user';
        }
    }
}
