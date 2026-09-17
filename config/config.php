<?php
define('APP_NAME', 'Sistema de Ventas');

$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
define('BASE_URL', $base . '/');

define('DEFAULT_CONTROLLER', 'venta');
define('DEFAULT_ACTION', 'index');

function url($path = '') {
    return BASE_URL . ltrim($path, '/');
}