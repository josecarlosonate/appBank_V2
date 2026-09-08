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
            "SELECT id, balance, account_number, account_type, is_active FROM accounts
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

    public function create(
        int $customerId,
        string $accountNumber,
        string $accountType,
        float $balance
    ): bool {

        $stmt = $this->pdo->prepare(
            "INSERT INTO accounts ( customer_id, account_number, account_type, balance, is_active )
                    VALUES (:customer_id, :account_number, :account_type, :balance, 1 )"
        );

        return $stmt->execute([
            'customer_id' => $customerId,
            'account_number' => $accountNumber,
            'account_type' => $accountType,
            'balance' => $balance
        ]);
    }

    public function generateAccountNumber(): string
    {
        /* Formato de cuenta: 31-72978-990 */
        do {
            $part1 = random_int(10, 99);
            $part2 = random_int(10000, 99999);
            $part3 = random_int(100, 999);

            $accountNumber = "{$part1}-{$part2}-{$part3}";
        } while ($this->accountNumberExists($accountNumber));

        return $accountNumber;
    }

    public function accountNumberExists(string $accountNumber): bool
    {
        $stmt = $this->pdo->prepare("SELECT id FROM accounts WHERE account_number = :account_number");

        $stmt->execute([
            'account_number' => $accountNumber
        ]);

        return $stmt->fetch() !== false;
    }
}
