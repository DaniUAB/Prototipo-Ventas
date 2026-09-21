<?php
require_once __DIR__ . '/../layout.php';

$porModulo = [];
foreach ($permisos as $p) {
    $porModulo[$p['modulo']][] = $p;
}
layout_head('Permisos de ' . $usuario['nombre']);
?>
<div class="card form-page" style="max-width: 720px;">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0"><i class="bi bi-key me-2"></i>Permisos de <?= htmlspecialchars($usuario['nombre']) ?></h5>
        <a class="btn btn-outline-secondary btn-sm" href="<?= url('index.php?c=permiso&a=index') ?>">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>
    <div class="card-body">
        <?php if ($usuario['rol'] === 'admin'): ?>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <div>Este usuario es administrador y tiene acceso total, no requiere permisos.</div>
            </div>
        <?php endif; ?>
        <form method="POST" action="<?= url('index.php?c=permiso&a=editar&id=' . $usuario['id']) ?>">
            <div class="row">
            <?php foreach ($porModulo as $modulo => $lista): ?>
                <div class="col-md-6 mb-3">
                    <div class="border rounded p-3 h-100">
                        <h6 class="text-capitalize mb-2"><?= htmlspecialchars($modulo) ?></h6>
                        <?php foreach ($lista as $p): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permisos[]"
                                       id="permiso<?= $p['id'] ?>" value="<?= $p['id'] ?>"
                                       <?= in_array((int)$p['id'], $asignados) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="permiso<?= $p['id'] ?>">
                                    <?= htmlspecialchars($p['descripcion']) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <button class="btn btn-brand" type="submit">
                <i class="bi bi-save me-1"></i>Guardar permisos
            </button>
        </form>
    </div>
</div>
<?php layout_foot(); ?>
