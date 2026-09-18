<?php
$item = $item ?? [];
?>
<div class="mb-3">
    <label class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($item['nombre'] ?? '') ?>" required>
</div>
<div class="mb-3">
    <label class="form-label">Documento</label>
    <input type="text" class="form-control" name="documento" value="<?= htmlspecialchars($item['documento'] ?? '') ?>">
</div>
<div class="mb-3">
    <label class="form-label">Teléfono</label>
    <input type="text" class="form-control" name="telefono" value="<?= htmlspecialchars($item['telefono'] ?? '') ?>">
</div>
<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($item['email'] ?? '') ?>">
</div>
<div class="mb-3">
    <label class="form-label">Dirección</label>
    <input type="text" class="form-control" name="direccion" value="<?= htmlspecialchars($item['direccion'] ?? '') ?>">
</div>
