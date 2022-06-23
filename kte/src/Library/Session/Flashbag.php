<?php

namespace Library\Session;

class Flashbag
{

    public function getError(string $field): ?string
    {
        if (!isset($_SESSION['error'][$field])) {
            return null;
        }

        $message = $_SESSION['error'][$field];
        unset($_SESSION['error'][$field]);

        return '<div class="error"><p>' . $message . '</p></div>';
    }

    public function hasError(string $field): bool
    {
        return isset($_SESSION['error'][$field]);
    }

    public function addError(string $field, string $message): void
    {
        $_SESSION['error'][$field] = $message;
    }

    public function getSuccess(string $field): ?string
    {
        if (!isset($_SESSION['success'][$field])) {
            return null;
        }

        $message = $_SESSION['success'][$field];
        unset($_SESSION['success'][$field]);

        return '<div class="success"><p>' . $message . '</p></div>';
    }

    public function hasSuccess(string $field): bool
    {
        return isset($_SESSION['success'][$field]);
    }

    public function addSuccess(string $field, string $message): void
    {
        $_SESSION['success'][$field] = $message;
    }
}