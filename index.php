<?php
session_start();
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/auth.php';

$controller = $_GET['c'] ?? DEFAULT_CONTROLLER;
$action     = $_GET['a'] ?? DEFAULT_ACTION;

$publicas = ['auth'];
if (!in_array($controller, $publicas, true)) {
    require_login();

    $permiso = permiso_requerido($controller, $action);
    if ($permiso !== null) {
        require_permiso($permiso);
    }
}

$file = __DIR__ . '/controllers/' . ucfirst($controller) . 'Controller.php';

if (!file_exists($file)) {
    die("Controlador no encontrado");
}
require_once $file;

$class = ucfirst($controller) . 'Controller';
$obj = new $class();

if (!method_exists($obj, $action)) {
    die("Acción no encontrada");
}
$obj->$action();