<?php
require_once __DIR__ . '/../layout.php';
layout_head('Nueva Venta');
?>
<div class="card">
    <div class="card-header">
        <h3>Registrar Venta</h3>
        <a class="btn btn-secondary" href="<?= url('index.php?c=venta&a=index') ?>">Volver</a>
    </div>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="<?= url('index.php?c=venta&a=crear') ?>">
        <div class="field">
            <label>Cliente</label>
            <select name="cliente_id" required>
                <option value="">Seleccione un cliente</option>
                <?php foreach ($clientes as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="field">
            <label>Productos</label>
            <div id="items">
                <div class="row item">
                    <select name="producto_id[]">
                        <?php foreach ($productos as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nombre']) ?> - Bs <?= number_format($p['precio'], 2) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="cantidad[]" value="1" min="1">
                </div>
            </div>
            <button type="button" class="btn btn-secondary btn-sm" onclick="agregarItem()">+ Agregar producto</button>
        </div>
        <button class="btn" type="submit">Guardar venta</button>
    </form>
</div>
<script>
function agregarItem() {
    const div = document.querySelector('.item').cloneNode(true);
    div.querySelector('input').value = 1;
    document.getElementById('items').appendChild(div);
}
</script>
<?php layout_foot(); ?>