<?php require_once __DIR__ . '/../layout.php'; layout_head('Detalle de Categoría'); ?>
<div class="card">
    <div class="card-header">
        <h3>Detalle de Categoría</h3>
        <a class="btn btn-secondary" href="<?= url('index.php?c=categoria&a=index') ?>">Volver</a>
    </div>
    <?php if (!$categoria): ?>
        <p class="empty">Categoría no encontrada.</p>
    <?php else: ?>
        <div class="detail-row"><span class="label">ID</span><span><?= $categoria['id'] ?></span></div>
        <div class="detail-row"><span class="label">Nombre</span><span><?= htmlspecialchars($categoria['nombre']) ?></span></div>
        <div class="detail-row"><span class="label">Descripción</span><span><?= htmlspecialchars($categoria['descripcion'] ?? '') ?></span></div>
    <?php endif; ?>
</div>
<?php layout_foot(); ?>