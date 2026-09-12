<?php

namespace App\Controllers;

use App\Enums\AccountRegistrationResult;
use App\Models\Account;

class AccountsController
{
    public function __construct(
        private Account $account
    ) {}

    private function redirect(string $location): never
    {
        header("Location: {$location}");
        exit;
    }

    public function index(): void
    {
        $customerId = (int) $_SESSION['customer_id'];
        $accounts = $this->account->findByCustomerId($customerId);
        $registeredAccounts = $this->account->findRegisteredByCustomerId($customerId);

        require __DIR__ . '/../views/accounts/index.php';
    }

    public function updateStatus(): void
    {
        $accountId = filter_var(
            $_POST['account_id'] ?? null,
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );

        if ($accountId === false) {
            $_SESSION['error'] = 'No fue posible modificar la cuenta.';
            $this->redirect('/accounts');
        }

        $customerId = (int) $_SESSION['customer_id'];

        $accountData = $this->account->findByIdAndCustomerId($accountId, $customerId);

        if ($accountData === false) {
            $_SESSION['error'] = 'No fue posible modificar la cuenta.';
            $this->redirect('/accounts');
        }

        $newStatus = $accountData['is_active'] == 1 ? 0 : 1;

        $updated =  $this->account->updateStatus($accountId, $customerId, $newStatus);

        if (!$updated) {
            $_SESSION['error'] = 'No fue posible modificar la cuenta.';
        } else {
            $_SESSION['success'] = 'El estado de la cuenta se actualizó correctamente.';
        }

        $this->redirect('/accounts');
    }

    public function store(): void
    {
        $accountType = $_POST['account_type'] ?? '';
        $balance = $_POST['balance'] ?? '';
        $customerId = (int) $_SESSION['customer_id'];

        if (
            !is_string($balance) || !preg_match('/^\d{1,13}(\.\d{1,2})?$/', $balance)
        ) {
            $_SESSION['error'] = 'El saldo ingresado no es válido.';
            $this->redirect('/accounts/create');
        }

        if (!in_array($accountType, ['SAVINGS', 'CHECKING'], true)) {
            $_SESSION['error'] = 'El tipo de cuenta no es válido.';
            $this->redirect('/accounts/create');
        }

        $balance = (float) $balance;
        $accountNumber = $this->account->generateAccountNumber();
        $created = $this->account->create($customerId, $accountNumber, $accountType, $balance);

        if (!$created) {
            $_SESSION['error'] = 'No fue posible registrar la cuenta.';
            $this->redirect('/accounts/create');
        }

        $_SESSION['success'] = 'La nueva cuenta fue registrada correctamente.';
        $this->redirect('/accounts');
    }

    // inscripcion cuenta de tercero
    public function register(): void
    {
        $accountNumber = trim($_POST['account_number'] ?? '');
        $documentNumber = trim($_POST['document_number'] ?? '');
        $customerId = (int) $_SESSION['customer_id'];

        // PASO 1: Verificar que la cuenta existe y coincide con el documento provisto
        $accountData = $this->account->findByAccountNumberAndDocument($accountNumber, $documentNumber);
        if ($accountData === false) {
            $_SESSION['error'] = AccountRegistrationResult::ACCOUNT_NOT_FOUND->message();
            $this->redirect('/accounts/register');
        }

        // PASO 2: Verificar que no sea una cuenta propia
        if ($customerId === (int)$accountData['customer_id']) {
            $_SESSION['error'] = AccountRegistrationResult::OWN_ACCOUNT->message();
            $this->redirect('/accounts/register');
        }

        // PASO 3: Verificar que no se intente inscribir dos veces la misma cuenta
        if ($this->account->isAlreadyRegistered($customerId, (int)$accountData['account_id'])) {
            $_SESSION['error'] = AccountRegistrationResult::ALREADY_REGISTERED->message();
            $this->redirect('/accounts/register');
        }

        // PASO 4: Si superó todas las reglas, se guarda con éxito
        $registered = $this->account->register($customerId, (int)$accountData['account_id']);
        if (!$registered) {
            $_SESSION['error'] = AccountRegistrationResult::REGISTRATION_FAILED->message();
            $this->redirect('/accounts/register');
        }

        $_SESSION['success'] = AccountRegistrationResult::SUCCESS->message();
        $this->redirect('/accounts');
    }

    // eliminar inscripción de cuenta de tercero
    public function unregister(): void
    {
        $accountId = filter_var(
            $_POST['account_id'] ?? null,
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );

        if ($accountId === false) {
            $_SESSION['error'] = 'No fue posible desvincular la cuenta.';
            $this->redirect('/accounts');
        }

        $customerId = (int) $_SESSION['customer_id'];
        $unregistered = $this->account->unregister($customerId, $accountId);


        if (!$unregistered) {
            $_SESSION['error'] = 'No fue posible desvincular la cuenta';
            $this->redirect('/accounts');
        }

        $_SESSION['success'] = 'La cuenta fue desvinculada correctamente.';
        $this->redirect('/accounts');
    }
}
