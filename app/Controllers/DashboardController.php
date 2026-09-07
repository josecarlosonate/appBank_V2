<?php

namespace App\Controllers;

use App\Models\Customer;

class DashboardController
{
    public function __construct(
        private Customer $customer
    ) {}

    public function index(int $customerId): ?array
    {
        $customerData = $this->customer->findById($customerId);

        if ($customerData === false) {
            return null;
        }

        return $customerData;
    }
}
