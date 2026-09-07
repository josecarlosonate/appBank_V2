<?php

namespace App\Models;

use PDO;

class Account
{
    public function __construct(
        private PDO $pdo
    ) {}

    public function findByCustomerId(int $customerId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, balance, account_number, is_active FROM accounts
         WHERE customer_id = :customer_id"
        );

        $stmt->execute([
            'customer_id' => $customerId
        ]);

        return $stmt->fetchAll();
    }

    public function findByIdAndCustomerId(
        int $accountId,
        int $customerId
    ): array|false {

        $stmt = $this->pdo->prepare(
            "SELECT id, is_active FROM accounts
                WHERE id = :account_id AND customer_id = :customer_id"
        );

        $stmt->execute([
            'account_id' => $accountId,
            'customer_id' => $customerId
        ]);

        return $stmt->fetch();
    }

    public function updateStatus(
        int $accountId,
        int $customerId,
        int $status
    ): bool {

        $stmt = $this->pdo->prepare(
            "UPDATE accounts  SET is_active = :status
                WHERE id = :account_id  AND customer_id = :customer_id"
        );

        return $stmt->execute([
            'account_id' => $accountId,
            'customer_id' => $customerId,
            'status' => $status
        ]);
    }
}
