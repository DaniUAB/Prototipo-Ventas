<?php require_once __DIR__ . '/../layout.php'; layout_head('Detalle de Usuario'); ?>
<div class="card">
    <div class="card-header">
        <h3>Detalle de Usuario</h3>
        <a class="btn btn-secondary" href="<?= url('index.php?c=usuario&a=index') ?>">Volver</a>
    </div>
    <?php if (!$usuario): ?>
        <p class="empty">Usuario no encontrado.</p>
    <?php else: ?>
        <div class="detail-row"><span class="label">ID</span><span><?= $usuario['id'] ?></span></div>
        <div class="detail-row"><span class="label">Nombre</span><span><?= htmlspecialchars($usuario['nombre']) ?></span></div>
        <div class="detail-row"><span class="label">Email</span><span><?= htmlspecialchars($usuario['email']) ?></span></div>
        <div class="detail-row"><span class="label">Rol</span><span><?= htmlspecialchars($usuario['rol']) ?></span></div>
        <div class="detail-row"><span class="label">Registrado</span><span><?= htmlspecialchars($usuario['created_at'] ?? '') ?></span></div>
    <?php endif; ?>
</div>
<?php layout_foot(); ?>