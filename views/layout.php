<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/auth.php';

function layout_head($title = 'Sistema de Ventas') {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?> | <?= APP_NAME ?></title>
    <style>
        :root {
            --sidebar: #1f2937; --sidebar-hover: #374151; --primary: #2563eb;
            --bg: #f3f4f6; --card: #ffffff; --text: #111827; --muted: #6b7280;
            --green: #16a34a; --red: #dc2626; --yellow: #d97706;
        }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Segoe UI', Roboto, Arial, sans-serif; background: var(--bg); color: var(--text); display: flex; min-height: 100vh; }
        a { text-decoration: none; color: inherit; }
        .sidebar { width: 230px; background: var(--sidebar); color: #e5e7eb; flex-shrink: 0; padding: 20px 0; }
        .sidebar h2 { font-size: 18px; padding: 0 20px 16px; margin: 0; color: #fff; border-bottom: 1px solid #374151; }
        .sidebar nav a { display: block; padding: 12px 20px; font-size: 14px; transition: .2s; }
        .sidebar nav a:hover { background: var(--sidebar-hover); color: #fff; }
        .main { flex: 1; display: flex; flex-direction: column; min-width: 0; }
        .topbar { background: #fff; padding: 16px 24px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 1px 3px rgba(0,0,0,.08); }
        .topbar h1 { font-size: 18px; margin: 0; }
        .topbar .user { font-size: 13px; color: var(--muted); display: flex; align-items: center; gap: 8px; }
        .content { padding: 24px; flex: 1; }
        .card { background: var(--card); border-radius: 10px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,.08); margin-bottom: 20px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .card-header h3 { margin: 0; font-size: 16px; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th, td { padding: 10px 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #f9fafb; color: var(--muted); text-transform: uppercase; font-size: 12px; letter-spacing: .4px; }
        tr:hover td { background: #f9fafb; }
        .btn { display: inline-block; padding: 8px 14px; border-radius: 6px; border: none; font-size: 13px; cursor: pointer; background: var(--primary); color: #fff; transition: .2s; }
        .btn:hover { opacity: .9; }
        .btn-sm { padding: 5px 10px; font-size: 12px; }
        .btn-success { background: var(--green); }
        .btn-danger { background: var(--red); }
        .btn-secondary { background: #6b7280; }
        .badge { padding: 3px 9px; border-radius: 999px; font-size: 12px; font-weight: 600; }
        .badge-blue { background: #dbeafe; color: #1e40af; }
        .badge-green { background: #dcfce7; color: #166534; }
        .badge-yellow { background: #fef9c3; color: #854d0e; }
        .badge-red { background: #fee2e2; color: #991b1b; }
        .badge-gray { background: #e5e7eb; color: #374151; }
        form .field { margin-bottom: 14px; }
        form label { display: block; margin-bottom: 5px; font-size: 13px; font-weight: 600; color: #374151; }
        form input, form select, form textarea { width: 100%; padding: 9px 11px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; }
        form input:focus, form select:focus, form textarea:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(37,99,235,.12); }
        .actions { display: flex; gap: 6px; }
        .row { display: flex; gap: 8px; margin-bottom: 8px; }
        .row select { flex: 1; }
        .row input { width: 90px; }
        .empty { text-align: center; color: var(--muted); padding: 24px; }
        .alert { padding: 10px 14px; border-radius: 6px; margin-bottom: 14px; font-size: 14px; }
        .alert-danger { background: #fee2e2; color: #991b1b; }
        .detail-row { display: flex; padding: 10px 0; border-bottom: 1px solid #e5e7eb; }
        .detail-row .label { width: 180px; color: var(--muted); font-weight: 600; }
    </style>
</head>
<body>
<aside class="sidebar">
    <h2><?= APP_NAME ?></h2>
    <nav>
        <?php if (can('ventas.ver')): ?>
            <a href="<?= url('index.php?c=venta&a=index') ?>">Ventas</a>
        <?php endif; ?>
        <?php if (can('clientes.ver')): ?>
            <a href="<?= url('index.php?c=cliente&a=index') ?>">Clientes</a>
        <?php endif; ?>
        <?php if (can('productos.ver')): ?>
            <a href="<?= url('index.php?c=producto&a=index') ?>">Productos</a>
        <?php endif; ?>
        <?php if (can('categorias.ver')): ?>
            <a href="<?= url('index.php?c=categoria&a=index') ?>">Categorías</a>
        <?php endif; ?>
        <?php if (can('usuarios.ver')): ?>
            <a href="<?= url('index.php?c=usuario&a=index') ?>">Usuarios</a>
        <?php endif; ?>
        <?php if (is_admin()): ?>
            <a href="<?= url('index.php?c=permiso&a=index') ?>">Permisos</a>
        <?php endif; ?>
    </nav>
</aside>
<div class="main">
    <header class="topbar">
        <h1><?= htmlspecialchars($title) ?></h1>
        <span class="user">
            <?= htmlspecialchars(auth_user_name()) ?>
            <span class="badge <?= is_admin() ? 'badge-red' : 'badge-blue' ?>"><?= htmlspecialchars(auth_user_role()) ?></span>
            <a class="btn btn-sm btn-secondary" href="<?= url('index.php?c=auth&a=salir') ?>">Cerrar Sesión</a>
        </span>
    </header>
    <div class="content">
<?php
}

function layout_foot() {
?>
    </div>
</div>
</body>
</html>
<?php
}