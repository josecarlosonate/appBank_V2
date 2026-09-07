<?php

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if ($method === 'GET' && $uri === '/login') {
    echo 'Aquí mostraremos el formulario de login';
}
