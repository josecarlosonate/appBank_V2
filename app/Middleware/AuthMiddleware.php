<?php

namespace App\Middleware;

class AuthMiddleware
{
    public function handle(): void
    {
        if (!isset($_SESSION['customer_id'])) {
            header('Location: /login');
            exit;
        }
    }
}
