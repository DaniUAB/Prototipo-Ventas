<?php require_once __DIR__ . '/../layout.php'; layout_head('Clientes'); ?>
<div class="card">
    <div class="card-header">
        <h3>Listado de Clientes</h3>
        <a class="btn" href="<?= url('index.php?c=cliente&a=crear') ?>">+ Nuevo Cliente</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($clientes)): ?>
            <tr><td colspan="6" class="empty">No hay clientes registrados</td></tr>
        <?php else: foreach ($clientes as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= htmlspecialchars($c['nombre']) ?></td>
                <td><?= htmlspecialchars($c['documento'] ?? '') ?></td>
                <td><?= htmlspecialchars($c['telefono'] ?? '') ?></td>
                <td><?= htmlspecialchars($c['email'] ?? '') ?></td>
                <td class="actions">
                    <a class="btn btn-sm btn-secondary" href="<?= url('index.php?c=cliente&a=ver&id=' . $c['id']) ?>">Ver</a>
                    <a class="btn btn-sm" href="<?= url('index.php?c=cliente&a=editar&id=' . $c['id']) ?>">Editar</a>
                    <a class="btn btn-sm btn-danger" href="<?= url('index.php?c=cliente&a=eliminar&id=' . $c['id']) ?>" onclick="return confirm('¿Eliminar este cliente?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
<?php layout_foot(); ?>