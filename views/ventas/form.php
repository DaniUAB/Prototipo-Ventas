<?php
require_once __DIR__ . '/../layout.php';
layout_head('Nueva Venta');
?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0"><i class="bi bi-cart-plus me-2"></i>Registrar Venta</h5>
        <a class="btn btn-outline-secondary btn-sm" href="<?= url('index.php?c=venta&a=index') ?>">
            <i class="bi bi-arrow-left me-1"></i>Volver
        </a>
    </div>
    <div class="card-body">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <div><?= htmlspecialchars($error) ?></div>
            </div>
        <?php endif; ?>
        <form method="POST" action="<?= url('index.php?c=venta&a=crear') ?>">
            <div class="mb-3" style="max-width: 480px;">
                <label class="form-label">Cliente</label>
                <select name="cliente_id" class="form-select" required>
                    <option value="">Seleccione un cliente</option>
                    <?php foreach ($clientes as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <label class="form-label">Productos</label>
            <div id="items" class="mb-2">
                <div class="row g-2 item mb-2">
                    <div class="col-md-8">
                        <select name="producto_id[]" class="form-select">
                            <?php foreach ($productos as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nombre']) ?> - Bs <?= number_format($p['precio'], 2) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="number" name="cantidad[]" class="form-control" value="1" min="1">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-secondary btn-sm mb-3" onclick="agregarItem()">
                <i class="bi bi-plus-lg me-1"></i>Agregar producto
            </button>
            <div>
                <button class="btn btn-brand" type="submit">
                    <i class="bi bi-save me-1"></i>Guardar venta
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function agregarItem() {
    const plantilla = document.querySelector('.item');
    const div = plantilla.cloneNode(true);
    div.querySelector('input').value = 1;
    document.getElementById('items').appendChild(div);
}
</script>
<?php layout_foot(); ?>
