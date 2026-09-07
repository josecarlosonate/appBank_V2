<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$pdo = require __DIR__ . '/../config/database.php';

require_once __DIR__ . '/../routes/web.php';
