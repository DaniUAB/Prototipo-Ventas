<?php require_once __DIR__ . '/../layout.php'; layout_head('Ventas'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0"><i class="bi bi-cart me-2"></i>Listado de Ventas</h5>
        <a class="btn btn-brand btn-sm" href="<?= url('index.php?c=venta&a=crear') ?>">
            <i class="bi bi-plus-lg me-1"></i>Nueva Venta
        </a>
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
                            <a class="btn btn-outline-secondary" href="<?= url('index.php?c=venta&a=ver&id=' . $v['id']) ?>">Ver</a>
                            <a class="btn btn-outline-danger" href="<?= url('index.php?c=venta&a=eliminar&id=' . $v['id']) ?>" onclick="return confirm('¿Anular esta venta? Se devolverá el stock.')">Anular</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php layout_foot(); ?>
