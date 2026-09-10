<?php

namespace App\Controllers;

use App\Enums\AccountRegistrationResult;
use App\Models\Account;

class AccountsController
{
    public function __construct(
        private Account  $account
    ) {}

    public function index(int $customerId): array
    {
        $accounts = $this->account->findByCustomerId($customerId);
        $registeredAccounts = $this->account->findRegisteredByCustomerId($customerId);

        return [
            'accounts' => $accounts,
            'registeredAccounts' => $registeredAccounts
        ];
    }

    public function updateStatus(int $accountId, int $customerId): bool
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

    public function store(int $customerId, string $accountType, float $balance): bool
    {
        if (!in_array($accountType, ['SAVINGS', 'CHECKING'], true)) {
            return false;
        }

        if ($balance < 0) {
            return false;
        }

        $accountNumber = $this->account->generateAccountNumber();

        return $this->account->create(
            $customerId,
            $accountNumber,
            $accountType,
            $balance
        );
    }

    // inscribir cuentas de terceros
    public function register_account(int $customerId, string $accountNumber, string $documentNumber): AccountRegistrationResult
    {
        // PASO 1: Verificar que la cuenta existe y coincide con el documento provisto
        $accountData = $this->account->findByAccountNumberAndDocument($accountNumber, $documentNumber);
        if ($accountData === false) {
            return AccountRegistrationResult::ACCOUNT_NOT_FOUND;
        }

        // PASO 2: Verificar que no sea una cuenta propia
        if ($customerId === (int)$accountData['customer_id']) {
            return AccountRegistrationResult::OWN_ACCOUNT;
        }

        // PASO 3: Verificar que no se intente inscribir dos veces la misma cuenta
        if ($this->account->isAlreadyRegistered($customerId, (int)$accountData['account_id'])) {
            return AccountRegistrationResult::ALREADY_REGISTERED;
        }

        // PASO 4: Si superó todas las reglas, se guarda con éxito
        $register = $this->account->register($customerId, (int)$accountData['account_id']);
        if ($register === false) {
            return AccountRegistrationResult::REGISTRATION_FAILED;
        }

        return AccountRegistrationResult::SUCCESS;
    }
}
