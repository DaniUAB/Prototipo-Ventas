<?php require_once __DIR__ . '/../layout.php'; layout_head('Detalle de Venta'); ?>
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0"><i class="bi bi-receipt me-2"></i>Detalle de Venta #<?= htmlspecialchars($venta['id'] ?? '') ?></h5>
        <a class="btn btn-outline-secondary btn-sm" href="<?= url('index.php?c=venta&a=index') ?>">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>
    <div class="card-body">
    <?php if (!$venta): ?>
        <p class="text-center text-secondary mb-0 py-3">Venta no encontrada.</p>
    <?php else: ?>
        <dl class="row mb-0">
            <dt class="col-sm-3">Fecha</dt><dd class="col-sm-9"><?= htmlspecialchars($venta['fecha']) ?></dd>
            <dt class="col-sm-3">Cliente ID</dt><dd class="col-sm-9"><?= $venta['cliente_id'] ?></dd>
            <dt class="col-sm-3">Vendedor ID</dt><dd class="col-sm-9"><?= $venta['usuario_id'] ?></dd>
            <dt class="col-sm-3">Total</dt><dd class="col-sm-9 mb-0 fw-bold">Bs <?= number_format($venta['total'], 2) ?></dd>
        </dl>
    <?php endif; ?>
    </div>
</div>

<div class="card">
    <div class="card-header py-3">
        <h5 class="mb-0"><i class="bi bi-box-seam me-2"></i>Productos</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Producto</th>
                    <th class="text-end">Cantidad</th>
                    <th class="text-end">Precio Unitario</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($detalle)): ?>
                <tr><td colspan="4" class="text-center text-secondary py-4">Sin detalle</td></tr>
            <?php else: foreach ($detalle as $d): ?>
                <tr>
                    <td><?= htmlspecialchars($d['producto']) ?></td>
                    <td class="text-end"><?= (int)$d['cantidad'] ?></td>
                    <td class="text-end">Bs <?= number_format($d['precio_unitario'], 2) ?></td>
                    <td class="text-end fw-semibold">Bs <?= number_format($d['subtotal'], 2) ?></td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php layout_foot(); ?>
