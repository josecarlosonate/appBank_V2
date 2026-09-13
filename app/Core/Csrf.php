<?php

namespace App\Core;

class Csrf
{
    public function token(): string
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            return $_SESSION['csrf_token'];
        }
        return $_SESSION['csrf_token'];
    }

    public function validate(string $submittedToken): bool
    {
        if (
            $submittedToken === '' ||
            !isset($_SESSION['csrf_token'])
        ) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $submittedToken);
    }

    public function field(): string
    {
        $token = htmlspecialchars($this->token(), ENT_QUOTES, 'UTF-8');
        return '<input type="hidden" name="csrf_token" value="' . $token . '">';
    }
}
