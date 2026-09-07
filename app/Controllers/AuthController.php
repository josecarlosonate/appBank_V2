<?php

namespace App\Controllers;

use App\Models\Customer;

class AuthController
{
    public function __construct(
        private Customer $customer
    ) {}

    public function login(string $documentNumber, string $password): bool
    {
        $customerData = $this->customer->findByDocumentNumber($documentNumber);

        if ($customerData === false) {
            return false;
        }

        if (password_verify($password, $customerData['password'])) {
            session_regenerate_id(true);

            $_SESSION['customer_id'] = $customerData['id'];
            $_SESSION['first_name'] = $customerData['first_name'];
            $_SESSION['last_name'] = $customerData['last_name'];

            return true;
        }

        return false;
    }
}
