<?php require_once __DIR__ . '/../layout.php'; layout_head('Productos'); ?>
<div class="card">
    <div class="card-header">
        <h3>Listado de Productos</h3>
        <a class="btn" href="<?= url('index.php?c=producto&a=crear') ?>">+ Nuevo Producto</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($productos)): ?>
            <tr><td colspan="6" class="empty">No hay productos registrados</td></tr>
        <?php else: foreach ($productos as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['nombre']) ?></td>
                <td><span class="badge badge-blue"><?= htmlspecialchars($p['categoria']) ?></span></td>
                <td>Bs <?= number_format($p['precio'], 2) ?></td>
                <td>
                    <span class="badge <?= $p['stock'] > 0 ? 'badge-green' : 'badge-red' ?>">
                        <?= (int)$p['stock'] ?>
                    </span>
                </td>
                <td class="actions">
                    <a class="btn btn-sm btn-secondary" href="<?= url('index.php?c=producto&a=ver&id=' . $p['id']) ?>">Ver</a>
                    <a class="btn btn-sm" href="<?= url('index.php?c=producto&a=editar&id=' . $p['id']) ?>">Editar</a>
                    <a class="btn btn-sm btn-danger" href="<?= url('index.php?c=producto&a=eliminar&id=' . $p['id']) ?>" onclick="return confirm('¿Eliminar este producto?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
<?php layout_foot(); ?>