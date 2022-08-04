<?php

namespace Library\Auth;

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
        session_start();
    }

    public function isAuthenticated(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public function getUserId () : int
    {
        return $_SESSION['user_id'];
    }

    public function isAdmin(): bool
    {
        return isset($_SESSION['admin']);
    }

    public function getRole(): string {
        if ($this->isAdmin()) {
            return 'administrateur';
        } else {
            return 'utilisateur';
        }
    }
}
