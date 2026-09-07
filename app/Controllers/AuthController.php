<?php

namespace App\Controllers;

use App\Models\Customer;

class AuthController
{
    public function __construct(
        private Customer $customer
    ) {}

    public function login(string $documentNumber, string $password): array|false
    {
        $customerData = $this->customer->findByDocumentNumber($documentNumber);

        if ($customerData === false) {
            return false;
        }

        if (!password_verify($password, $customerData['password'])) {
            return false;
        }

        return $customerData;
    }
}
