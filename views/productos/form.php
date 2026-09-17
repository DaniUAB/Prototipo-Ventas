<?php
require_once __DIR__ . '/../layout.php';
$editar = isset($producto) && $producto;
$accion = $editar ? 'editar&id=' . $producto['id'] : 'crear';
layout_head($editar ? 'Editar Producto' : 'Nuevo Producto');
?>
<div class="card">
    <div class="card-header">
        <h3><?= $editar ? 'Editar Producto' : 'Nuevo Producto' ?></h3>
        <a class="btn btn-secondary" href="<?= url('index.php?c=producto&a=index') ?>">Volver</a>
    </div>
    <form method="POST" action="<?= url('index.php?c=producto&a=' . $accion) ?>">
        <div class="field">
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre'] ?? '') ?>" required>
        </div>
        <div class="field">
            <label>Categoría</label>
            <select name="categoria_id" required>
                <option value="">Seleccione una categoría</option>
                <?php foreach ($categorias as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= (($producto['categoria_id'] ?? '') == $c['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="field">
            <label>Precio (Bs)</label>
            <input type="number" name="precio" step="0.01" min="0" value="<?= htmlspecialchars($producto['precio'] ?? '') ?>" required>
        </div>
        <div class="field">
            <label>Stock</label>
            <input type="number" name="stock" min="0" value="<?= htmlspecialchars($producto['stock'] ?? 0) ?>" required>
        </div>
        <button class="btn" type="submit"><?= $editar ? 'Actualizar' : 'Guardar' ?></button>
    </form>
</div>
<?php layout_foot(); ?>