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

    public function updateStatus(int $accountId, int $customerId)
    {
        $accountData = $this->account->findByIdAndCustomerId($accountId, $customerId);

        if ($accountData === false) {
            return false;
        }

        $newStatus = $accountData['is_active'] == 1 ? 0 : 1;

        return $this->account->updateStatus(
            $accountId,
            $customerId,
            $newStatus
        );
    }
}
