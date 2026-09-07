<?php

namespace App\Models;

use PDO;

class Customer
{
    public function __construct(
        private PDO $pdo
    ) {}

    public function findByDocumentNumber(string $documentNumber): array|false
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, document_number, password FROM customers
         WHERE document_number = :document_number"
        );

        $stmt->execute([
            'document_number' => $documentNumber
        ]);

        return $stmt->fetch();
    }

    public function findById(int $id): array|false
    {
        $stmt = $this->pdo->prepare(
            "SELECT first_name, last_name FROM customers
         WHERE id = :id"
        );

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch();
    }
}
