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
}
