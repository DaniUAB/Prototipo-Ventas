<?php
require_once __DIR__ . '/../layout.php';
$editar = isset($categoria) && $categoria;
$accion = $editar ? 'editar&id=' . $categoria['id'] : 'crear';
layout_head($editar ? 'Editar Categoría' : 'Nueva Categoría');
?>
<div class="card">
    <div class="card-header">
        <h3><?= $editar ? 'Editar Categoría' : 'Nueva Categoría' ?></h3>
        <a class="btn btn-secondary" href="<?= url('index.php?c=categoria&a=index') ?>">Volver</a>
    </div>
    <form method="POST" action="<?= url('index.php?c=categoria&a=' . $accion) ?>">
        <div class="field">
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($categoria['nombre'] ?? '') ?>" required>
        </div>
        <div class="field">
            <label>Descripción</label>
            <textarea name="descripcion" rows="3"><?= htmlspecialchars($categoria['descripcion'] ?? '') ?></textarea>
        </div>
        <button class="btn" type="submit"><?= $editar ? 'Actualizar' : 'Guardar' ?></button>
    </form>
</div>
<?php layout_foot(); ?>