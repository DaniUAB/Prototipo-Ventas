<?php
require_once __DIR__ . '/../layout.php';
$editar = isset($cliente) && $cliente;
$accion = $editar ? 'editar&id=' . $cliente['id'] : 'crear';
layout_head($editar ? 'Editar Cliente' : 'Nuevo Cliente');
?>
<div class="card">
    <div class="card-header">
        <h3><?= $editar ? 'Editar Cliente' : 'Nuevo Cliente' ?></h3>
        <a class="btn btn-secondary" href="<?= url('index.php?c=cliente&a=index') ?>">Volver</a>
    </div>
    <form method="POST" action="<?= url('index.php?c=cliente&a=' . $accion) ?>">
        <div class="field">
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($cliente['nombre'] ?? '') ?>" required>
        </div>
        <div class="field">
            <label>Documento</label>
            <input type="text" name="documento" value="<?= htmlspecialchars($cliente['documento'] ?? '') ?>">
        </div>
        <div class="field">
            <label>Teléfono</label>
            <input type="text" name="telefono" value="<?= htmlspecialchars($cliente['telefono'] ?? '') ?>">
        </div>
        <div class="field">
            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($cliente['email'] ?? '') ?>">
        </div>
        <div class="field">
            <label>Dirección</label>
            <input type="text" name="direccion" value="<?= htmlspecialchars($cliente['direccion'] ?? '') ?>">
        </div>
        <button class="btn" type="submit"><?= $editar ? 'Actualizar' : 'Guardar' ?></button>
    </form>
</div>
<?php layout_foot(); ?>