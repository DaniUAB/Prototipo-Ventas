<?php require_once __DIR__ . '/../layout.php'; layout_head('Categorías'); ?>
<div class="card">
    <div class="card-header">
        <h3>Listado de Categorías</h3>
        <a class="btn" href="<?= url('index.php?c=categoria&a=crear') ?>">+ Nueva Categoría</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($categorias)): ?>
            <tr><td colspan="4" class="empty">No hay categorías registradas</td></tr>
        <?php else: foreach ($categorias as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= htmlspecialchars($c['nombre']) ?></td>
                <td><?= htmlspecialchars($c['descripcion'] ?? '') ?></td>
                <td class="actions">
                    <a class="btn btn-sm btn-secondary" href="<?= url('index.php?c=categoria&a=ver&id=' . $c['id']) ?>">Ver</a>
                    <a class="btn btn-sm" href="<?= url('index.php?c=categoria&a=editar&id=' . $c['id']) ?>">Editar</a>
                    <a class="btn btn-sm btn-danger" href="<?= url('index.php?c=categoria&a=eliminar&id=' . $c['id']) ?>" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
<?php layout_foot(); ?>