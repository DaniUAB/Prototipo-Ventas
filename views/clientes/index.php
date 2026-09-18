<?php require_once __DIR__ . '/../layout.php'; layout_head('Clientes'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0"><i class="bi bi-people me-2"></i>Listado de Clientes</h5>
        <?php modal_trigger('modalClienteCrear', 'Nuevo Cliente'); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($clientes)): ?>
                <tr><td colspan="6" class="text-center text-secondary py-4">No hay clientes registrados</td></tr>
            <?php else: foreach ($clientes as $c): ?>
                <tr>
                    <td><?= $c['id'] ?></td>
                    <td><?= htmlspecialchars($c['nombre']) ?></td>
                    <td><?= htmlspecialchars($c['documento'] ?? '') ?></td>
                    <td><?= htmlspecialchars($c['telefono'] ?? '') ?></td>
                    <td><?= htmlspecialchars($c['email'] ?? '') ?></td>
                    <td class="text-end">
                        <div class="btn-group btn-group-sm">
                            <a class="btn btn-outline-secondary" href="<?= url('index.php?c=cliente&a=ver&id=' . $c['id']) ?>">Ver</a>
                            <?php modal_trigger('modalClienteEditar' . $c['id'], 'Editar', 'btn btn-outline-primary', 'bi-pencil'); ?>
                            <a class="btn btn-outline-danger" href="<?= url('index.php?c=cliente&a=eliminar&id=' . $c['id']) ?>" onclick="return confirm('¿Eliminar este cliente?')">Eliminar</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php modal_open('modalClienteCrear', 'Nuevo Cliente', url('index.php?c=cliente&a=crear')); ?>
    <?php $item = []; require __DIR__ . '/_campos.php'; ?>
<?php modal_close('Guardar'); ?>

<?php foreach ($clientes as $c): ?>
    <?php modal_open('modalClienteEditar' . $c['id'], 'Editar Cliente', url('index.php?c=cliente&a=editar&id=' . $c['id'])); ?>
        <?php $item = $c; require __DIR__ . '/_campos.php'; ?>
    <?php modal_close('Actualizar'); ?>
<?php endforeach; ?>

<?php layout_foot(); ?>
