<?php require_once __DIR__ . '/../layout.php'; layout_head('Ventas'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0"><i class="bi bi-cart me-2"></i>Listado de Ventas</h5>
        <?php if (can('ventas.gestionar')): ?>
            <a class="btn btn-brand btn-sm" href="<?= url('index.php?c=venta&a=crear') ?>">
                <i class="bi bi-plus-lg me-1"></i>Nueva Venta
            </a>
        <?php endif; ?>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th class="text-end">Total</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($ventas)): ?>
                <tr><td colspan="6" class="text-center text-secondary py-4">No hay ventas registradas</td></tr>
            <?php else: foreach ($ventas as $v): ?>
                <tr>
                    <td><?= $v['id'] ?></td>
                    <td><?= htmlspecialchars($v['fecha']) ?></td>
                    <td><?= htmlspecialchars($v['cliente']) ?></td>
                    <td><?= htmlspecialchars($v['usuario']) ?></td>
                    <td class="text-end fw-semibold">Bs <?= number_format($v['total'], 2) ?></td>
                    <td class="text-end">
                        <div class="btn-group btn-group-sm">
                            <?php if (can('ventas.ver')): modal_trigger('modalVentaVer' . $v['id'], 'Ver', 'btn btn-outline-secondary', 'bi-eye'); endif; ?>
                            <?php if (can('ventas.gestionar')): ?>
                                <a class="btn btn-outline-danger" href="<?= url('index.php?c=venta&a=eliminar&id=' . $v['id']) ?>" onclick="return confirm('¿Anular esta venta? Se devolverá el stock.')">Anular</a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php foreach ($ventas as $v): ?>
    <?php modal_open('modalVentaVer' . $v['id'], 'Detalle de Venta #' . $v['id'], null, 'lg', 'bi-eye'); ?>
        <dl class="row mb-3">
            <dt class="col-sm-3">Fecha</dt><dd class="col-sm-9"><?= htmlspecialchars($v['fecha']) ?></dd>
            <dt class="col-sm-3">Cliente</dt><dd class="col-sm-9"><?= htmlspecialchars($v['cliente']) ?></dd>
            <dt class="col-sm-3">Vendedor</dt><dd class="col-sm-9"><?= htmlspecialchars($v['usuario']) ?></dd>
            <dt class="col-sm-3">Total</dt><dd class="col-sm-9 mb-0 fw-bold">Bs <?= number_format($v['total'], 2) ?></dd>
        </dl>
        <h6 class="mb-2"><i class="bi bi-box-seam me-1"></i>Productos</h6>
        <div class="table-responsive">
            <table class="table table-sm table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th class="text-end">Cantidad</th>
                        <th class="text-end">Precio Unitario</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                <?php $itemsDetalle = $detalles[$v['id']] ?? []; ?>
                <?php if (empty($itemsDetalle)): ?>
                    <tr><td colspan="4" class="text-center text-secondary py-3">Sin detalle</td></tr>
                <?php else: foreach ($itemsDetalle as $d): ?>
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
    <?php modal_close(); ?>
<?php endforeach; ?>

<?php layout_foot(); ?>
