<?php require_once __DIR__ . '/../layout.php'; layout_head('Usuarios'); ?>
<div class="card">
    <div class="card-header">
        <h3>Listado de Usuarios</h3>
        <a class="btn" href="<?= url('index.php?c=usuario&a=crear') ?>">+ Nuevo Usuario</a>
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
                    <a class="btn btn-sm btn-secondary" href="<?= url('index.php?c=usuario&a=ver&id=' . $u['id']) ?>">Ver</a>
                    <a class="btn btn-sm" href="<?= url('index.php?c=usuario&a=editar&id=' . $u['id']) ?>">Editar</a>
                    <a class="btn btn-sm btn-danger" href="<?= url('index.php?c=usuario&a=eliminar&id=' . $u['id']) ?>" onclick="return confirm('¿Eliminar este usuario?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
<?php layout_foot(); ?>