<?php require_once __DIR__ . '/../layout.php'; layout_head('Ventas'); ?>
<div class="card">
    <div class="card-header">
        <h3>Listado de Ventas</h3>
        <a class="btn" href="<?= url('index.php?c=venta&a=crear') ?>">+ Nueva Venta</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($ventas)): ?>
            <tr><td colspan="6" class="empty">No hay ventas registradas</td></tr>
        <?php else: foreach ($ventas as $v): ?>
            <tr>
                <td><?= $v['id'] ?></td>
                <td><?= htmlspecialchars($v['fecha']) ?></td>
                <td><?= htmlspecialchars($v['cliente']) ?></td>
                <td><?= htmlspecialchars($v['usuario']) ?></td>
                <td><strong>Bs <?= number_format($v['total'], 2) ?></strong></td>
                <td class="actions">
                    <a class="btn btn-sm btn-secondary" href="<?= url('index.php?c=venta&a=ver&id=' . $v['id']) ?>">Ver</a>
                    <a class="btn btn-sm btn-danger" href="<?= url('index.php?c=venta&a=eliminar&id=' . $v['id']) ?>" onclick="return confirm('¿Anular esta venta? Se devolverá el stock.')">Anular</a>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
<?php layout_foot(); ?>