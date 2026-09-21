<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/partials/modal.php';

function layout_head($title = 'Sistema de Ventas') {
    $actual = $_GET['c'] ?? DEFAULT_CONTROLLER;
    $menu = [
        ['c' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'bi-speedometer2', 'perm' => 'ventas.ver'],
        ['c' => 'venta',     'label' => 'Ventas',     'icon' => 'bi-cart',         'perm' => 'ventas.ver'],
        ['c' => 'cliente',  'label' => 'Clientes',   'icon' => 'bi-people',       'perm' => 'clientes.ver'],
        ['c' => 'producto', 'label' => 'Productos',  'icon' => 'bi-box-seam',     'perm' => 'productos.ver'],
        ['c' => 'categoria','label' => 'Categorías', 'icon' => 'bi-tags',         'perm' => 'categorias.ver'],
        ['c' => 'usuario',  'label' => 'Usuarios',   'icon' => 'bi-person-badge', 'perm' => 'usuarios.ver'],
        ['c' => 'permiso',  'label' => 'Permisos',   'icon' => 'bi-shield-lock',  'perm' => null, 'admin' => true],
    ];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?> | <?= APP_NAME ?></title>
    <link rel="stylesheet" href="<?= asset('styles/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('styles/css/bootstrap-icons.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('styles/css/app.css') ?>">
</head>
<body>
<div class="app-shell" id="appShell">
    <aside class="app-sidebar" id="appSidebar">
        <h2 class="brand"><i class="bi bi-shop"></i><span><?= APP_NAME ?></span></h2>
        <nav class="nav flex-column mt-2">
            <?php foreach ($menu as $item): ?>
                <?php if (!empty($item['admin']) ? is_admin() : can($item['perm'])): ?>
                    <a class="nav-link<?= $actual === $item['c'] ? ' active' : '' ?>"
                       href="<?= url('index.php?c=' . $item['c'] . '&a=index') ?>">
                        <i class="bi <?= $item['icon'] ?>"></i>
                        <span class="nav-text"><?= $item['label'] ?></span>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </nav>
    </aside>
    <div class="app-main">
        <header class="app-topbar">
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-outline-secondary btn-sm" id="btnSidebar" title="Mostrar/ocultar menú">
                    <i class="bi bi-layout-sidebar"></i>
                </button>
                <h1 class="mb-0"><?= htmlspecialchars($title) ?></h1>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="text-secondary small"><?= htmlspecialchars(auth_user_name()) ?></span>
                <span class="badge text-bg-<?= is_admin() ? 'danger' : 'primary' ?>"><?= htmlspecialchars(auth_user_role()) ?></span>
                <a class="btn btn-outline-secondary btn-sm" href="<?= url('index.php?c=auth&a=salir') ?>">
                    <i class="bi bi-box-arrow-right me-1"></i>Cerrar Sesión
                </a>
            </div>
        </header>
        <main class="app-content">
            <?php require __DIR__ . '/partials/alerts.php'; ?>
<?php
}

function layout_foot() {
?>
        </main>
    </div>
</div>
<script src="<?= asset('styles/js/bootstrap.bundle.min.js') ?>"></script>
<script>
(function () {
    const shell = document.getElementById('appShell');
    const btn = document.getElementById('btnSidebar');
    if (!shell || !btn) { return; }

    const abierto = localStorage.getItem('sidebar_abierto') !== 'false';
    if (!abierto) { shell.classList.add('sidebar-collapsed'); }

    btn.addEventListener('click', function () {
        const colapsar = !shell.classList.contains('sidebar-collapsed');
        shell.classList.toggle('sidebar-collapsed', colapsar);
        localStorage.setItem('sidebar_abierto', String(!colapsar));
    });
})();
</script>
</body>
</html>
<?php
}
