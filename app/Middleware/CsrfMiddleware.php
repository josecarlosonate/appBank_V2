<?php

namespace App\Middleware;

use App\Core\Csrf;

class CsrfMiddleware
{
    public function __construct(private Csrf $csrf) {}

    public function handle(): void
    {
        $submittedToken = $_POST['csrf_token'] ?? '';

        if (
            !is_string($submittedToken) ||
            !$this->csrf->validate($submittedToken)
        ) {
            http_response_code(403);
            exit;
        }
    }
}
