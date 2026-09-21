<?php
require_once __DIR__ . '/../layout.php';
$esEdicion = isset($categoria) && $categoria;
$item = $categoria ?? [];
$accion = $esEdicion ? 'editar&id=' . $categoria['id'] : 'crear';
layout_head($esEdicion ? 'Editar Categoría' : 'Nueva Categoría');
?>
<div class="card form-page" style="max-width: 640px;">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0"><?= $esEdicion ? 'Editar Categoría' : 'Nueva Categoría' ?></h5>
        <a class="btn btn-outline-secondary btn-sm" href="<?= url('index.php?c=categoria&a=index') ?>">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>
    <div class="card-body">
        <form method="POST" action="<?= url('index.php?c=categoria&a=' . $accion) ?>">
            <?php require __DIR__ . '/_campos.php'; ?>
            <button class="btn btn-brand" type="submit">
                <i class="bi bi-save me-1"></i><?= $esEdicion ? 'Actualizar' : 'Guardar' ?>
            </button>
        </form>
    </div>
</div>
<?php layout_foot(); ?>
