<?php require_once __DIR__ . '/../layout.php'; layout_head('Detalle de Venta'); ?>
<div class="card">
    <div class="card-header">
        <h3>Detalle de Venta #<?= htmlspecialchars($venta['id'] ?? '') ?></h3>
        <a class="btn btn-secondary" href="<?= url('index.php?c=venta&a=index') ?>">Volver</a>
    </div>
    <?php if (!$venta): ?>
        <p class="empty">Venta no encontrada.</p>
    <?php else: ?>
        <div class="detail-row"><span class="label">Fecha</span><span><?= htmlspecialchars($venta['fecha']) ?></span></div>
        <div class="detail-row"><span class="label">Cliente ID</span><span><?= $venta['cliente_id'] ?></span></div>
        <div class="detail-row"><span class="label">Vendedor ID</span><span><?= $venta['usuario_id'] ?></span></div>
        <div class="detail-row"><span class="label">Total</span><span><strong>Bs <?= number_format($venta['total'], 2) ?></strong></span></div>
    <?php endif; ?>
</div>

<div class="card">
    <div class="card-header"><h3>Productos</h3></div>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($detalle)): ?>
            <tr><td colspan="4" class="empty">Sin detalle</td></tr>
        <?php else: foreach ($detalle as $d): ?>
            <tr>
                <td><?= htmlspecialchars($d['producto']) ?></td>
                <td><?= (int)$d['cantidad'] ?></td>
                <td>Bs <?= number_format($d['precio_unitario'], 2) ?></td>
                <td>Bs <?= number_format($d['subtotal'], 2) ?></td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
<?php layout_foot(); ?>