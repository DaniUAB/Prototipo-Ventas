<?php
require_once __DIR__ . '/../layout.php';

$porModulo = [];
foreach ($permisos as $p) {
    $porModulo[$p['modulo']][] = $p;
}
layout_head('Permisos de ' . $usuario['nombre']);
?>
<div class="card">
    <div class="card-header">
        <h3>Permisos de <?= htmlspecialchars($usuario['nombre']) ?></h3>
        <a class="btn btn-secondary" href="<?= url('index.php?c=permiso&a=index') ?>">Volver</a>
    </div>
    <?php if ($usuario['rol'] === 'admin'): ?>
        <div class="alert alert-danger">Este usuario es administrador y tiene acceso total, no requiere permisos.</div>
    <?php endif; ?>
    <form method="POST" action="<?= url('index.php?c=permiso&a=editar&id=' . $usuario['id']) ?>">
        <?php foreach ($porModulo as $modulo => $lista): ?>
            <div class="field">
                <label style="text-transform: capitalize"><?= htmlspecialchars($modulo) ?></label>
                <?php foreach ($lista as $p): ?>
                    <label style="font-weight: normal; display:flex; align-items:center; gap:8px; margin-bottom:6px">
                        <input type="checkbox" name="permisos[]" value="<?= $p['id'] ?>" style="width:auto"
                            <?= in_array((int)$p['id'], $asignados) ? 'checked' : '' ?>>
                        <?= htmlspecialchars($p['descripcion']) ?>
                    </label>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        <button class="btn" type="submit">Guardar permisos</button>
    </form>
</div>
<?php layout_foot(); ?>