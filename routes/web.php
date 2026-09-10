<?php

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

use App\Controllers\AccountsController;
use App\Models\Customer;
use App\Controllers\AuthController;
use App\Models\Account;
use App\Enums\AccountRegistrationResult;

/** @var \PDO $pdo */

/*=============================================
INICIO
=============================================*/

if ($method === 'GET' && $uri === '/') {
    require __DIR__ . '/../app/views/home.php';
}

/*=============================================
AUTENTICACIÓN
=============================================*/

if ($method === 'GET' && $uri === '/login') {

    require __DIR__ . '/../app/views/auth/login.php';
}

if ($method === 'POST' && $uri === '/login') {

    $documentNumber = $_POST['document_number'];
    $password = $_POST['password'];
    $customer = new Customer($pdo);
    $authController = new AuthController($customer);
    $customerData = $authController->login($documentNumber, $password);

    if ($customerData !== false) {
        session_regenerate_id(true);

        $_SESSION['customer_id'] = $customerData['id'];
        $_SESSION['first_name'] = $customerData['first_name'];
        $_SESSION['last_name'] = $customerData['last_name'];

        header('Location: /dashboard');
        exit;
    }

    $_SESSION['error'] = 'Credenciales incorrectas';

    header('Location: /login');
    exit;
}

if ($method === 'POST' && $uri === '/logout') {

    $_SESSION = [];
    session_destroy();
    header('Location: /login');
    exit;
}

/*=============================================
DASHBOARD
=============================================*/

if ($method === 'GET' && $uri === '/dashboard') {

    if (!isset($_SESSION['customer_id'])) {
        header('Location: /login');
        exit;
    }

    require __DIR__ . '/../app/views/dashboard.php';
}

/*=============================================
CUENTAS
=============================================*/

if ($method === 'GET' && $uri === '/accounts') {

    if (!isset($_SESSION['customer_id'])) {
        header('Location: /login');
        exit;
    }

    $account = new Account($pdo);
    $accountsController = new AccountsController($account);
    $accountData = $accountsController->index((int) $_SESSION['customer_id']);
    ['accounts' => $accounts, 'registeredAccounts' => $registeredAccounts] = $accountData;

    require __DIR__ . '/../app/Views/accounts/index.php';
}

if ($method === 'POST' && $uri === '/accounts/status') {

    if (!isset($_SESSION['customer_id'])) {
        header('Location: /login');
        exit;
    }

    if (!isset($_POST['account_id'])) {
        $_SESSION['error'] = 'No fue posible modificar la cuenta.';

        header('Location: /accounts');
        exit;
    }

    $accountId = $_POST['account_id'];

    $account = new Account($pdo);
    $accountsController = new AccountsController($account);

    $updated = $accountsController->updateStatus((int) $accountId, (int) $_SESSION['customer_id']);

    if (!$updated) {
        $_SESSION['error'] = 'No fue posible modificar la cuenta.';
    } else {
        $_SESSION['success'] = 'El estado de la cuenta se actualizó correctamente.';
    }

    header('Location: /accounts');
    exit;
}

if ($method === 'GET' && $uri === '/accounts/create') {

    if (!isset($_SESSION['customer_id'])) {
        header('Location: /login');
        exit;
    }

    require __DIR__ . '/../app/views/accounts/create.php';
}

if ($method === 'POST' && $uri === '/accounts') {

    if (!isset($_SESSION['customer_id'])) {
        header('Location: /login');
        exit;
    }

    $accountType = $_POST['account_type'] ?? '';
    $balance = $_POST['balance'] ?? '';

    if (
        !is_string($balance) ||
        !preg_match('/^\d{1,13}(\.\d{1,2})?$/', $balance)
    ) {
        $_SESSION['error'] = 'El saldo ingresado no es válido.';
        header('Location: /accounts/create');
        exit;
    }

    $balance = (float) $balance;

    $account = new Account($pdo);
    $accountsController = new AccountsController($account);
    $created = $accountsController->store((int) $_SESSION['customer_id'], $accountType, $balance);

    if (!$created) {
        $_SESSION['error'] = 'No fue posible registrar la cuenta.';
        header('Location: /accounts/create');
        exit;
    } else {
        $_SESSION['success'] = 'La nueva cuenta fue registrada correctamente.';
    }

    header('Location: /accounts');
    exit;
}

if ($method === 'GET' && $uri === '/accounts/register') {

    if (!isset($_SESSION['customer_id'])) {
        header('Location: /login');
        exit;
    }

    require __DIR__ . '/../app/views/accounts/register.php';
}

if ($method === 'POST' && $uri === '/accounts/register') {

    if (!isset($_SESSION['customer_id'])) {
        header('Location: /login');
        exit;
    }

    $accountNumber = trim($_POST['account_number'] ?? '');
    $documentNumber = trim($_POST['document_number'] ?? '');

    $account = new Account($pdo);
    $accountsController = new AccountsController($account);
    $result = $accountsController->register_account((int) $_SESSION['customer_id'], $accountNumber, $documentNumber);

    $mensage = match ($result) {
        AccountRegistrationResult::ACCOUNT_NOT_FOUND => 'La cuenta o el documento no coinciden.',
        AccountRegistrationResult::OWN_ACCOUNT => 'No puedes inscribir una cuenta propia.',
        AccountRegistrationResult::ALREADY_REGISTERED => 'Esta cuenta ya está inscrita.',
        AccountRegistrationResult::REGISTRATION_FAILED => 'No fue posible registrar la cuenta.',
        AccountRegistrationResult::SUCCESS => 'La nueva cuenta fue registrada correctamente.'
    };

    if ($result === AccountRegistrationResult::SUCCESS) {
        $_SESSION['success'] = $mensage;
        header('Location: /accounts');
        exit;
    } else {
        $_SESSION['error'] = $mensage;
        header('Location: /accounts/register');
        exit;
    }
}

/*=============================================
TRANSFERENCIAS
=============================================*/

/*=============================================
MOVIMIENTOS
=============================================*/