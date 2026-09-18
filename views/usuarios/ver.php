<?php require_once __DIR__ . '/../layout.php'; layout_head('Detalle de Usuario'); ?>
<div class="card" style="max-width: 640px;">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Detalle de Usuario</h5>
        <a class="btn btn-outline-secondary btn-sm" href="<?= url('index.php?c=usuario&a=index') ?>">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>
    <div class="card-body">
    <?php if (!$usuario): ?>
        <p class="text-center text-secondary mb-0 py-3">Usuario no encontrado.</p>
    <?php else: ?>
        <dl class="row mb-0">
            <dt class="col-sm-4">ID</dt><dd class="col-sm-8"><?= $usuario['id'] ?></dd>
            <dt class="col-sm-4">Nombre</dt><dd class="col-sm-8"><?= htmlspecialchars($usuario['nombre']) ?></dd>
            <dt class="col-sm-4">Email</dt><dd class="col-sm-8"><?= htmlspecialchars($usuario['email']) ?></dd>
            <dt class="col-sm-4">Rol</dt><dd class="col-sm-8"><?= htmlspecialchars($usuario['rol']) ?></dd>
            <dt class="col-sm-4">Registrado</dt><dd class="col-sm-8 mb-0"><?= htmlspecialchars($usuario['created_at'] ?? '') ?></dd>
        </dl>
    <?php endif; ?>
    </div>
</div>
<?php layout_foot(); ?>
