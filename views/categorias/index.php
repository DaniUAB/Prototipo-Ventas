<?php require_once __DIR__ . '/../layout.php'; layout_head('Categorías'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0"><i class="bi bi-tags me-2"></i>Listado de Categorías</h5>
        <?php if (can('categorias.gestionar')): modal_trigger('modalCategoriaCrear', 'Nueva Categoría'); endif; ?>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($categorias)): ?>
                <tr><td colspan="4" class="text-center text-secondary py-4">No hay categorías registradas</td></tr>
            <?php else: foreach ($categorias as $c): ?>
                <tr>
                    <td><?= $c['id'] ?></td>
                    <td><?= htmlspecialchars($c['nombre']) ?></td>
                    <td><?= htmlspecialchars($c['descripcion'] ?? '') ?></td>
                    <td class="text-end">
                        <div class="btn-group btn-group-sm">
                            <?php if (can('categorias.ver')): modal_trigger('modalCategoriaVer' . $c['id'], 'Ver', 'btn btn-outline-secondary', 'bi-eye'); endif; ?>
                            <?php if (can('categorias.gestionar')): ?>
                                <?php modal_trigger('modalCategoriaEditar' . $c['id'], 'Editar', 'btn btn-outline-primary', 'bi-pencil'); ?>
                                <a class="btn btn-outline-danger" href="<?= url('index.php?c=categoria&a=eliminar&id=' . $c['id']) ?>" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php modal_open('modalCategoriaCrear', 'Nueva Categoría', url('index.php?c=categoria&a=crear')); ?>
    <?php $item = []; require __DIR__ . '/_campos.php'; ?>
<?php modal_close('Guardar'); ?>

<?php foreach ($categorias as $c): ?>
    <?php modal_open('modalCategoriaVer' . $c['id'], 'Detalle de Categoría', null, '', 'bi-eye'); ?>
        <dl class="row mb-0">
            <dt class="col-sm-4">ID</dt><dd class="col-sm-8"><?= $c['id'] ?></dd>
            <dt class="col-sm-4">Nombre</dt><dd class="col-sm-8"><?= htmlspecialchars($c['nombre']) ?></dd>
            <dt class="col-sm-4">Descripción</dt><dd class="col-sm-8 mb-0"><?= htmlspecialchars($c['descripcion'] ?? '') ?></dd>
        </dl>
    <?php modal_close(); ?>

    <?php modal_open('modalCategoriaEditar' . $c['id'], 'Editar Categoría', url('index.php?c=categoria&a=editar&id=' . $c['id'])); ?>
        <?php $item = $c; require __DIR__ . '/_campos.php'; ?>
    <?php modal_close('Actualizar'); ?>
<?php endforeach; ?>

<?php layout_foot(); ?>
