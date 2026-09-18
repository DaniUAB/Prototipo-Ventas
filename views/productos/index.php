<?php require_once __DIR__ . '/../layout.php'; layout_head('Productos'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0"><i class="bi bi-box-seam me-2"></i>Listado de Productos</h5>
        <?php modal_trigger('modalProductoCrear', 'Nuevo Producto'); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($productos)): ?>
                <tr><td colspan="6" class="text-center text-secondary py-4">No hay productos registrados</td></tr>
            <?php else: foreach ($productos as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['nombre']) ?></td>
                    <td><span class="badge text-bg-primary"><?= htmlspecialchars($p['categoria']) ?></span></td>
                    <td>Bs <?= number_format($p['precio'], 2) ?></td>
                    <td>
                        <span class="badge text-bg-<?= $p['stock'] > 0 ? 'success' : 'danger' ?>">
                            <?= (int)$p['stock'] ?>
                        </span>
                    </td>
                    <td class="text-end">
                        <div class="btn-group btn-group-sm">
                            <a class="btn btn-outline-secondary" href="<?= url('index.php?c=producto&a=ver&id=' . $p['id']) ?>">Ver</a>
                            <?php modal_trigger('modalProductoEditar' . $p['id'], 'Editar', 'btn btn-outline-primary', 'bi-pencil'); ?>
                            <a class="btn btn-outline-danger" href="<?= url('index.php?c=producto&a=eliminar&id=' . $p['id']) ?>" onclick="return confirm('¿Eliminar este producto?')">Eliminar</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php modal_open('modalProductoCrear', 'Nuevo Producto', url('index.php?c=producto&a=crear')); ?>
    <?php $item = []; require __DIR__ . '/_campos.php'; ?>
<?php modal_close('Guardar'); ?>

<?php foreach ($productos as $p): ?>
    <?php modal_open('modalProductoEditar' . $p['id'], 'Editar Producto', url('index.php?c=producto&a=editar&id=' . $p['id'])); ?>
        <?php $item = $p; require __DIR__ . '/_campos.php'; ?>
    <?php modal_close('Actualizar'); ?>
<?php endforeach; ?>

<?php layout_foot(); ?>
