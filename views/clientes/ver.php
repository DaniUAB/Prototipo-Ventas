<?php require_once __DIR__ . '/../layout.php'; layout_head('Detalle de Cliente'); ?>
<div class="card" style="max-width: 640px;">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Detalle de Cliente</h5>
        <a class="btn btn-outline-secondary btn-sm" href="<?= url('index.php?c=cliente&a=index') ?>">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>
    <div class="card-body">
    <?php if (!$cliente): ?>
        <p class="text-center text-secondary mb-0 py-3">Cliente no encontrado.</p>
    <?php else: ?>
        <dl class="row mb-0">
            <dt class="col-sm-4">ID</dt><dd class="col-sm-8"><?= $cliente['id'] ?></dd>
            <dt class="col-sm-4">Nombre</dt><dd class="col-sm-8"><?= htmlspecialchars($cliente['nombre']) ?></dd>
            <dt class="col-sm-4">Documento</dt><dd class="col-sm-8"><?= htmlspecialchars($cliente['documento'] ?? '') ?></dd>
            <dt class="col-sm-4">Teléfono</dt><dd class="col-sm-8"><?= htmlspecialchars($cliente['telefono'] ?? '') ?></dd>
            <dt class="col-sm-4">Email</dt><dd class="col-sm-8"><?= htmlspecialchars($cliente['email'] ?? '') ?></dd>
            <dt class="col-sm-4">Dirección</dt><dd class="col-sm-8"><?= htmlspecialchars($cliente['direccion'] ?? '') ?></dd>
            <dt class="col-sm-4">Registrado</dt><dd class="col-sm-8 mb-0"><?= htmlspecialchars($cliente['created_at'] ?? '') ?></dd>
        </dl>
    <?php endif; ?>
    </div>
</div>
<?php layout_foot(); ?>
