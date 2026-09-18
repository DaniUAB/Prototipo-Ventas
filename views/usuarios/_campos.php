<?php
$item = $item ?? [];
$esEdicion = !empty($esEdicion);
?>
<div class="mb-3">
    <label class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($item['nombre'] ?? '') ?>" required>
</div>
<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($item['email'] ?? '') ?>" required>
</div>
<div class="mb-3">
    <label class="form-label">Contraseña <?= $esEdicion ? '<span class="text-secondary fw-normal">(dejar en blanco para no cambiar)</span>' : '' ?></label>
    <input type="password" class="form-control" name="password" <?= $esEdicion ? '' : 'required' ?>>
</div>
<div class="mb-3">
    <label class="form-label">Rol</label>
    <select name="rol" class="form-select">
        <option value="vendedor" <?= (($item['rol'] ?? '') === 'vendedor') ? 'selected' : '' ?>>Vendedor</option>
        <option value="admin" <?= (($item['rol'] ?? '') === 'admin') ? 'selected' : '' ?>>Admin</option>
    </select>
</div>
