<?php
require_once __DIR__ . '/../layout.php';
$editar = isset($usuario) && $usuario;
$accion = $editar ? 'editar&id=' . $usuario['id'] : 'crear';
layout_head($editar ? 'Editar Usuario' : 'Nuevo Usuario');
?>
<div class="card">
    <div class="card-header">
        <h3><?= $editar ? 'Editar Usuario' : 'Nuevo Usuario' ?></h3>
        <a class="btn btn-secondary" href="<?= url('index.php?c=usuario&a=index') ?>">Volver</a>
    </div>
    <form method="POST" action="<?= url('index.php?c=usuario&a=' . $accion) ?>">
        <div class="field">
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre'] ?? '') ?>" required>
        </div>
        <div class="field">
            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($usuario['email'] ?? '') ?>" required>
        </div>
        <div class="field">
            <label>Contraseña <?= $editar ? '(dejar en blanco para no cambiar)' : '' ?></label>
            <input type="password" name="password" <?= $editar ? '' : 'required' ?>>
        </div>
        <div class="field">
            <label>Rol</label>
            <select name="rol">
                <option value="vendedor" <?= (($usuario['rol'] ?? '') === 'vendedor') ? 'selected' : '' ?>>Vendedor</option>
                <option value="admin" <?= (($usuario['rol'] ?? '') === 'admin') ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>
        <button class="btn" type="submit"><?= $editar ? 'Actualizar' : 'Guardar' ?></button>
    </form>
</div>
<?php layout_foot(); ?>