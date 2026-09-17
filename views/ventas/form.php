<!DOCTYPE html>
<html>
<head><title>Nueva Venta</title></head>
<body>
<h1>Registrar Venta</h1>

<?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="POST" action="index.php?c=venta&a=crear">
    <label>Cliente:</label>
    <select name="cliente_id" required>
        <?php foreach ($clientes as $c): ?>
            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nombre']) ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <div id="items">
        <div class="item">
            <select name="producto_id[]">
                <?php foreach ($productos as $p): ?>
                    <option value="<?= $p['id'] ?>">
                        <?= htmlspecialchars($p['nombre']) ?> - $<?= $p['precio'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="cantidad[]" value="1" min="1">
        </div>
    </div>
    <button type="button" onclick="agregarItem()">+ Agregar producto</button>
    <br><br>
    <button type="submit">Guardar venta</button>
</form>

<script>
function agregarItem() {
    const div = document.querySelector('.item').cloneNode(true);
    document.getElementById('items').appendChild(div);
}
</script>
</body>
</html>