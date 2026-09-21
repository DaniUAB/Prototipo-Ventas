<?php
require_once __DIR__ . '/../layout.php';
$esEdicion = isset($usuario) && $usuario;
$item = $usuario ?? [];
$accion = $esEdicion ? 'editar&id=' . $usuario['id'] : 'crear';
layout_head($esEdicion ? 'Editar Usuario' : 'Nuevo Usuario');
?>
<div class="card form-page" style="max-width: 640px;">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0"><?= $esEdicion ? 'Editar Usuario' : 'Nuevo Usuario' ?></h5>
        <a class="btn btn-outline-secondary btn-sm" href="<?= url('index.php?c=usuario&a=index') ?>">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>
    <div class="card-body">
        <form method="POST" action="<?= url('index.php?c=usuario&a=' . $accion) ?>">
            <?php require __DIR__ . '/_campos.php'; ?>
            <button class="btn btn-brand" type="submit">
                <i class="bi bi-save me-1"></i><?= $esEdicion ? 'Actualizar' : 'Guardar' ?>
            </button>
        </form>
    </div>
</div>
<?php layout_foot(); ?>
