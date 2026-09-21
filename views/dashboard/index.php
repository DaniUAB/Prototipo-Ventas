<?php
require_once __DIR__ . '/../layout.php';
layout_head('Dashboard');
?>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <i class="bi bi-currency-dollar display-5 text-success"></i>
                <div>
                    <div class="text-secondary small">Ganancias totales</div>
                    <div class="h4 mb-0">Bs <?= number_format((float)($resumen['ganancias'] ?? 0), 2) ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <i class="bi bi-cart-check display-5 text-primary"></i>
                <div>
                    <div class="text-secondary small">Ventas registradas</div>
                    <div class="h4 mb-0"><?= (int)($resumen['total_ventas'] ?? 0) ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <i class="bi bi-trophy display-5 text-warning"></i>
                <div class="text-truncate">
                    <div class="text-secondary small">Producto más vendido</div>
                    <div class="h5 mb-0 text-truncate">
                        <?php if (!empty($masVendidos)): ?>
                            <?= htmlspecialchars($masVendidos[0]['nombre']) ?>
                            <span class="text-secondary fs-6">(<?= (int)$masVendidos[0]['total_vendido'] ?> uds)</span>
                        <?php else: ?>
                            <span class="fs-6 text-secondary">Sin ventas aún</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="mb-3">Ganancias por día</h6>
                <canvas id="chartGanancias" height="280"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="mb-3">Stock disponible (menor a mayor)</h6>
                <canvas id="chartStock" height="280"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="<?= asset('styles/js/chart.umd.min.js') ?>"></script>
<script>
// Ganancias por día (línea con alzas y bajas)
const dias     = <?= json_encode(array_map(fn($d) => date('d/m', strtotime($d['dia'])), $gananciasDia)) ?>;
const ganancia = <?= json_encode(array_map(fn($d) => (float)$d['ganancia'], $gananciasDia)) ?>;

new Chart(document.getElementById('chartGanancias'), {
    type: 'line',
    data: {
        labels: dias,
        datasets: [{
            label: 'Bs ganados',
            data: ganancia,
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13,110,253,0.15)',
            fill: true,
            tension: 0.3,
            pointRadius: 5,
            pointBackgroundColor: '#0d6efd'
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});

// Stock disponible de menor a mayor (barras horizontales)
const nombresStock = <?= json_encode(array_column($menorStock, 'nombre')) ?>;
const stockActual  = <?= json_encode(array_map(fn($p) => (int)$p['stock'], $menorStock)) ?>;

new Chart(document.getElementById('chartStock'), {
    type: 'bar',
    data: {
        labels: nombresStock.map((n, i) => n + ' (' + stockActual[i] + ')' ),
        datasets: [{
            label: 'Unidades en stock',
            data: stockActual,
            backgroundColor: ['#dc3545', '#fd7e14', '#ffc107', '#20c997', '#0d6efd'],
            borderRadius: 6
        }]
    },
    options: {
        indexAxis: 'y',
        plugins: { legend: { display: false } },
        scales: { x: { beginAtZero: true, ticks: { precision: 0 } } }
    }
});
</script>
<?php layout_foot(); ?>