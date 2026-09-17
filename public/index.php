<?php
session_start();

$controller = $_GET['c'] ?? 'categoria';
$action     = $_GET['a'] ?? 'index';

$file = __DIR__ . "/../controllers/" . ucfirst($controller) . "Controller.php";

if (!file_exists($file)) {
    die("Controlador no encontrado");
}
require_once $file;

$class = ucfirst($controller) . "Controller";
$obj = new $class();

if (!method_exists($obj, $action)) {
    die("Acción no encontrada");
}
$obj->$action();