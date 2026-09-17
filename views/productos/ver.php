<?php require_once __DIR__ . '/../layout.php'; layout_head('Detalle de Producto'); ?>
<div class="card">
    <div class="card-header">
        <h3>Detalle de Producto</h3>
        <a class="btn btn-secondary" href="<?= url('index.php?c=producto&a=index') ?>">Volver</a>
    </div>
    <?php if (!$producto): ?>
        <p class="empty">Producto no encontrado.</p>
    <?php else: ?>
        <div class="detail-row"><span class="label">ID</span><span><?= $producto['id'] ?></span></div>
        <div class="detail-row"><span class="label">Nombre</span><span><?= htmlspecialchars($producto['nombre']) ?></span></div>
        <div class="detail-row"><span class="label">Categoría ID</span><span><?= $producto['categoria_id'] ?></span></div>
        <div class="detail-row"><span class="label">Precio</span><span>Bs <?= number_format($producto['precio'], 2) ?></span></div>
        <div class="detail-row"><span class="label">Stock</span><span><?= (int)$producto['stock'] ?></span></div>
    <?php endif; ?>
</div>
<?php layout_foot(); ?>