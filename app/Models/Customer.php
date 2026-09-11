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
            "SELECT id, first_name, last_name, document_number, password FROM customers
         WHERE document_number = :document_number"
        );

        $stmt->execute([
            'document_number' => $documentNumber
        ]);

        return $stmt->fetch();
    }
}
