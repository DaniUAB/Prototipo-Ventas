<?php require_once __DIR__ . '/../layout.php'; layout_head('Permisos de Usuario'); ?>
<div class="card">
    <div class="card-header">
        <h3>Control de Permisos</h3>
        <a class="btn btn-secondary" href="<?= url('index.php?c=usuario&a=index') ?>">Usuarios</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($usuarios)): ?>
            <tr><td colspan="5" class="empty">No hay usuarios registrados</td></tr>
        <?php else: foreach ($usuarios as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['nombre']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td>
                    <span class="badge <?= $u['rol'] === 'admin' ? 'badge-red' : 'badge-blue' ?>">
                        <?= htmlspecialchars($u['rol']) ?>
                    </span>
                </td>
                <td class="actions">
                    <?php if ($u['rol'] === 'admin'): ?>
                        <span class="badge badge-green">Acceso total</span>
                    <?php else: ?>
                        <a class="btn btn-sm" href="<?= url('index.php?c=permiso&a=editar&id=' . $u['id']) ?>">Asignar permisos</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
<?php layout_foot(); ?>