<?php

use App\Core\Container;
use App\Core\Router;

// 1. Cargar el Autoloader 
require_once __DIR__ . '/../vendor/autoload.php';

// 2. Iniciar sesión
session_start();

// 3. Cargar variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->safeLoad();

// 4. Cargar la conexión PDO
$pdo = require __DIR__ . '/../config/database.php';

// 5. Contenedor de Dependencias
$container = new Container();
$container->instance(PDO::class, $pdo);

// 6. Configurar Enrutador y Rutas
$router = new Router($container);
require_once __DIR__ . '/../routes/web.php';

// 7. Capturar la petición actual
$httpMethod = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 8. Despachar la ruta
$router->dispatch($httpMethod, $path);
