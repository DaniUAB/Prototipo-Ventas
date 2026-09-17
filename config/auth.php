<?php
require_once __DIR__ . '/../models/Permiso.php';

function auth_check() {
    return !empty($_SESSION['usuario_id']);
}

function auth_user_id() {
    return $_SESSION['usuario_id'] ?? null;
}

function auth_user_name() {
    return $_SESSION['usuario_nombre'] ?? '';
}

function auth_user_role() {
    return $_SESSION['usuario_rol'] ?? '';
}

function is_admin() {
    return auth_user_role() === 'admin';
}

function can($clave) {
    if (!auth_check()) {
        return false;
    }
    if (is_admin()) {
        return true;
    }
    static $claves = null;
    if ($claves === null) {
        $claves = (new Permiso())->clavesDeUsuario(auth_user_id());
    }
    return in_array($clave, $claves);
}

function require_login() {
    if (!auth_check()) {
        header('Location: ' . url('index.php?c=auth&a=index'));
        exit;
    }
}

function require_admin() {
    if (!is_admin()) {
        http_response_code(403);
        die('Acceso denegado: solo el administrador puede acceder a esta sección.');
    }
}

function require_permiso($clave) {
    if (!can($clave)) {
        http_response_code(403);
        die('Acceso denegado: no tienes permiso para esta sección.');
    }
}

function permiso_requerido($controller, $action) {
    $modulos = [
        'usuario'   => 'usuarios',
        'cliente'   => 'clientes',
        'categoria' => 'categorias',
        'producto'  => 'productos',
        'venta'     => 'ventas',
        'permiso'   => 'permisos'
    ];
    if (!isset($modulos[$controller])) {
        return null;
    }
    $escritura = ['crear', 'editar', 'eliminar'];
    return $modulos[$controller] . (in_array($action, $escritura) ? '.gestionar' : '.ver');
}