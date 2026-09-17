<?php require_once __DIR__ . '/../layout.php'; layout_head('Detalle de Cliente'); ?>
<div class="card">
    <div class="card-header">
        <h3>Detalle de Cliente</h3>
        <a class="btn btn-secondary" href="<?= url('index.php?c=cliente&a=index') ?>">Volver</a>
    </div>
    <?php if (!$cliente): ?>
        <p class="empty">Cliente no encontrado.</p>
    <?php else: ?>
        <div class="detail-row"><span class="label">ID</span><span><?= $cliente['id'] ?></span></div>
        <div class="detail-row"><span class="label">Nombre</span><span><?= htmlspecialchars($cliente['nombre']) ?></span></div>
        <div class="detail-row"><span class="label">Documento</span><span><?= htmlspecialchars($cliente['documento'] ?? '') ?></span></div>
        <div class="detail-row"><span class="label">Teléfono</span><span><?= htmlspecialchars($cliente['telefono'] ?? '') ?></span></div>
        <div class="detail-row"><span class="label">Email</span><span><?= htmlspecialchars($cliente['email'] ?? '') ?></span></div>
        <div class="detail-row"><span class="label">Dirección</span><span><?= htmlspecialchars($cliente['direccion'] ?? '') ?></span></div>
        <div class="detail-row"><span class="label">Registrado</span><span><?= htmlspecialchars($cliente['created_at'] ?? '') ?></span></div>
    <?php endif; ?>
</div>
<?php layout_foot(); ?>