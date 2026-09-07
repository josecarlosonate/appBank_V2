<?php

namespace App\Controllers;

use App\Models\Account;

class AccountsController
{
    public function __construct(
        private Account  $account
    ) {}

    public function index(int $customerId): array
    {
        $accounts = $this->account->findByCustomerId($customerId);

        return $accounts;
    }
}
