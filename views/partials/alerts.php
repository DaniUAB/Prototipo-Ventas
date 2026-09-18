<?php
$flashes = flashes();
if (!empty($flashes) || !empty($error)):
    $iconos = [
        'success' => 'bi-check-circle',
        'danger' => 'bi-exclamation-triangle',
        'warning' => 'bi-exclamation-circle',
        'info' => 'bi-info-circle',
    ];
?>
<?php if (!empty($error)): ?>
    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
        <span class="me-2"><?= $iconos['danger'] ? '<i class="bi ' . $iconos['danger'] . '"></i>' : '' ?></span>
        <div><?= htmlspecialchars($error) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
<?php endif; ?>
<?php foreach ($flashes as $f):
    $tipo = in_array($f['tipo'], ['success', 'danger', 'warning', 'info']) ? $f['tipo'] : 'info';
    $icono = $iconos[$tipo] ?? 'bi-info-circle';
?>
    <div class="alert alert-<?= $tipo ?> d-flex align-items-center alert-dismissible fade show" role="alert">
        <i class="bi <?= $icono ?> me-2"></i>
        <div><?= htmlspecialchars($f['mensaje']) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
<?php endforeach; ?>
<?php endif; ?>
