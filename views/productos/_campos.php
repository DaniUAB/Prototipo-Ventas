<?php
$item = $item ?? [];
?>
<div class="mb-3">
    <label class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($item['nombre'] ?? '') ?>" required>
</div>
<div class="mb-3">
    <label class="form-label">Categoría</label>
    <select name="categoria_id" class="form-select" required>
        <option value="">Seleccione una categoría</option>
        <?php foreach ($categorias as $c): ?>
            <option value="<?= $c['id'] ?>" <?= (($item['categoria_id'] ?? '') == $c['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($c['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Precio (Bs)</label>
        <input type="number" class="form-control" name="precio" step="0.01" min="0" value="<?= htmlspecialchars($item['precio'] ?? '') ?>" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Stock</label>
        <input type="number" class="form-control" name="stock" min="0" value="<?= htmlspecialchars($item['stock'] ?? 0) ?>" required>
    </div>
</div>
