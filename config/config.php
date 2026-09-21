<?php
require_once __DIR__ . '/validacion.php';

define('APP_NAME', 'Sistema de Ventas');

$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
define('BASE_URL', $base . '/');

define('DEFAULT_CONTROLLER', 'venta');
define('DEFAULT_ACTION', 'index');

function url($path = '') {
    return BASE_URL . ltrim($path, '/');
}

function asset($path = '') {
    return url($path);
}

function flash($tipo, $mensaje) {
    $_SESSION['flashes'][] = ['tipo' => $tipo, 'mensaje' => $mensaje];
}

function flashes() {
    $lista = $_SESSION['flashes'] ?? [];
    unset($_SESSION['flashes']);
    return $lista;
}