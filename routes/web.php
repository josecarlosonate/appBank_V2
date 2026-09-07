<?php

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

use App\Controllers\AccountsController;
use App\Models\Customer;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Models\Account;

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
    $authenticated = $authController->login($documentNumber, $password);

    if ($authenticated) {
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

    require __DIR__ . '/../app/Views/dashboard.php';
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
    $accounts = $accountsController->index((int) $_SESSION['customer_id']);

    require __DIR__ . '/../app/Views/accounts/index.php';
}

/*=============================================
TRANSFERENCIAS
=============================================*/

/*=============================================
MOVIMIENTOS
=============================================*/