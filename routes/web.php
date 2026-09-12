<?php

use App\Controllers\AccountsController;
use App\Controllers\AuthController;
use App\Middleware\AuthMiddleware;

// Rutas públicas
$router->view('/', 'home');
$router->view('/login', 'auth/login');
$router->post('/login', [AuthController::class, 'login']);
// Rutas protegidas
$router->view('/dashboard', 'dashboard', AuthMiddleware::class);
$router->get('/accounts', [AccountsController::class, 'index'], AuthMiddleware::class);
$router->post('/accounts', [AccountsController::class, 'store'], AuthMiddleware::class);
$router->post('/logout', [AuthController::class, 'logout'], AuthMiddleware::class);
$router->view('/accounts/create', 'accounts/create', AuthMiddleware::class);
$router->post('/accounts/status', [AccountsController::class, 'updateStatus'], AuthMiddleware::class);
// Rutas protegidas - Cuentas inscritas
$router->view('/accounts/register', 'accounts/register', AuthMiddleware::class);
$router->post('/accounts/register', [AccountsController::class, 'register'], AuthMiddleware::class);
$router->post('/accounts/unregister', [AccountsController::class, 'unregister'], AuthMiddleware::class);
