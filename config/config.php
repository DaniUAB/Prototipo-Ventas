<?php
require_once __DIR__ . '/validacion.php';

define('APP_NAME', 'Sistema de Ventas');

$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
define('BASE_URL', $base . '/');

define('DEFAULT_CONTROLLER', 'dashboard');
define('DEFAULT_ACTION', 'index');

function url($path = '') {
    return BASE_URL . ltrim($path, '/');
}

function asset($path = '') {
    $u = url($path);
    // Cache-busting: agrega ?v=<mtime> para que el navegador
    // siempre descargue la version nueva tras cambios.
    $archivo = __DIR__ . '/../' . ltrim($path, '/');
    if (is_file($archivo)) { $u .= '?v=' . filemtime($archivo); }
    return $u;
}
function flash($tipo, $mensaje) {
    $_SESSION['flashes'][] = ['tipo' => $tipo, 'mensaje' => $mensaje];
}

function flashes() {
    $lista = $_SESSION['flashes'] ?? [];
    unset($_SESSION['flashes']);
    return $lista;
}