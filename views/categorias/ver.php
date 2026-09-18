<?php require_once __DIR__ . '/../layout.php'; layout_head('Detalle de Categoría'); ?>
<div class="card" style="max-width: 640px;">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Detalle de Categoría</h5>
        <a class="btn btn-outline-secondary btn-sm" href="<?= url('index.php?c=categoria&a=index') ?>">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>
    <div class="card-body">
    <?php if (!$categoria): ?>
        <p class="text-center text-secondary mb-0 py-3">Categoría no encontrada.</p>
    <?php else: ?>
        <dl class="row mb-0">
            <dt class="col-sm-4">ID</dt><dd class="col-sm-8"><?= $categoria['id'] ?></dd>
            <dt class="col-sm-4">Nombre</dt><dd class="col-sm-8"><?= htmlspecialchars($categoria['nombre']) ?></dd>
            <dt class="col-sm-4">Descripción</dt><dd class="col-sm-8 mb-0"><?= htmlspecialchars($categoria['descripcion'] ?? '') ?></dd>
        </dl>
    <?php endif; ?>
    </div>
</div>
<?php layout_foot(); ?>
