<?php
$item = $item ?? [];
?>
<div class="mb-3">
    <label class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($item['nombre'] ?? '') ?>" required>
</div>
<div class="mb-3">
    <label class="form-label">Descripción</label>
    <textarea class="form-control" name="descripcion" rows="3"><?= htmlspecialchars($item['descripcion'] ?? '') ?></textarea>
</div>
