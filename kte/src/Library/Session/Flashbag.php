<?php

namespace Library\Session;

class Flashbag
{

    public function hasError(string $field): bool
    {
        return isset($_SESSION['error'][$field]);
    }

    public function addError(string $field, string $message): void
    {
        $_SESSION['error'][$field] = $message;
    }

    public function getError(string $field): ?string
    {
        if (!isset($_SESSION['error'][$field])) {
            return null;
        }
        $message = $_SESSION['error'][$field];
        unset($_SESSION['error'][$field]);
    return <<<HTML
            <div class="alert-error">
                <small class="text-danger">$message</small>
            </div>
    HTML;
    }

    public function addGlobalError(string $field, string $message): void {
        $_SESSION['global_error'][$field] = $message;
    }

    private function getGlobalError(string $field): ?string
    {
        if (!isset($_SESSION['global_error'][$field])) {
            return null;
        }
        $message = $_SESSION['global_error'][$field];
        unset($_SESSION['global_error'][$field]);
        return <<<HTML
            <div class="alert   alert-errors">
                <p class="text-dangers">$message</p>
            </div>
    HTML;
    }

    private function displayErrors(): string
    {
        return <<<HTML
                <div class="alert alert-errors">
                    <p class="text-danger">Un ou plusieurs champs sont invalides.</p>
                </div>
        HTML;
    }

    public function hasSuccess(string $field): bool
    {
        return isset($_SESSION['success'][$field]);
    }

    public function addSuccess(string $field, string $message): void
    {
        $_SESSION['success'][$field] = $message;
    }

    private function getSuccess(string $field): ?string
    {
        if (!isset($_SESSION['success'][$field])) {
            return null;
        }

        $message = $_SESSION['success'][$field];
        unset($_SESSION['error']);
        unset($_SESSION['success'][$field]);
        return <<<HTML
            <div class="alert alert-success">
                <p class="text-success">$message</p>
            </div>
        HTML;
    }

    public function display(): ?string
    {
        if (!empty($_SESSION['success'])) {
            foreach ($_SESSION['success'] as $field => $message) {
                return $this->getSuccess($field);
            }
        }
        if (!empty($_SESSION['error'])) {
            return $this->displayErrors();
        }
        if (!empty($_SESSION['global_error'])) {
            foreach ($_SESSION['global_error'] as $field => $message) {
                return $this->getGlobalError($field);
            }
        }
        return null;
    }
}