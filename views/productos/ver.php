<?php require_once __DIR__ . '/../layout.php'; layout_head('Detalle de Producto'); ?>
<div class="card" style="max-width: 640px;">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Detalle de Producto</h5>
        <a class="btn btn-outline-secondary btn-sm" href="<?= url('index.php?c=producto&a=index') ?>">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>
    <div class="card-body">
    <?php if (!$producto): ?>
        <p class="text-center text-secondary mb-0 py-3">Producto no encontrado.</p>
    <?php else: ?>
        <dl class="row mb-0">
            <dt class="col-sm-4">ID</dt><dd class="col-sm-8"><?= $producto['id'] ?></dd>
            <dt class="col-sm-4">Nombre</dt><dd class="col-sm-8"><?= htmlspecialchars($producto['nombre']) ?></dd>
            <dt class="col-sm-4">Categoría ID</dt><dd class="col-sm-8"><?= $producto['categoria_id'] ?></dd>
            <dt class="col-sm-4">Precio</dt><dd class="col-sm-8">Bs <?= number_format($producto['precio'], 2) ?></dd>
            <dt class="col-sm-4">Stock</dt><dd class="col-sm-8 mb-0"><?= (int)$producto['stock'] ?></dd>
        </dl>
    <?php endif; ?>
    </div>
</div>
<?php layout_foot(); ?>
