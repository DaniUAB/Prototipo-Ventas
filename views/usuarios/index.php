<?php require_once __DIR__ . '/../layout.php'; layout_head('Usuarios'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Listado de Usuarios</h5>
        <?php modal_trigger('modalUsuarioCrear', 'Nuevo Usuario'); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($usuarios)): ?>
                <tr><td colspan="5" class="text-center text-secondary py-4">No hay usuarios registrados</td></tr>
            <?php else: foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['nombre']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td>
                        <span class="badge text-bg-<?= $u['rol'] === 'admin' ? 'danger' : 'primary' ?>">
                            <?= htmlspecialchars($u['rol']) ?>
                        </span>
                    </td>
                    <td class="text-end">
                        <div class="btn-group btn-group-sm">
                            <a class="btn btn-outline-secondary" href="<?= url('index.php?c=usuario&a=ver&id=' . $u['id']) ?>">Ver</a>
                            <?php modal_trigger('modalUsuarioEditar' . $u['id'], 'Editar', 'btn btn-outline-primary', 'bi-pencil'); ?>
                            <a class="btn btn-outline-danger" href="<?= url('index.php?c=usuario&a=eliminar&id=' . $u['id']) ?>" onclick="return confirm('¿Eliminar este usuario?')">Eliminar</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php modal_open('modalUsuarioCrear', 'Nuevo Usuario', url('index.php?c=usuario&a=crear')); ?>
    <?php $item = []; $esEdicion = false; require __DIR__ . '/_campos.php'; ?>
<?php modal_close('Guardar'); ?>

<?php foreach ($usuarios as $u): ?>
    <?php modal_open('modalUsuarioEditar' . $u['id'], 'Editar Usuario', url('index.php?c=usuario&a=editar&id=' . $u['id'])); ?>
        <?php $item = $u; $esEdicion = true; require __DIR__ . '/_campos.php'; ?>
    <?php modal_close('Actualizar'); ?>
<?php endforeach; ?>

<?php layout_foot(); ?>
