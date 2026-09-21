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
                <i class="bi bi-receipt display-5 text-info"></i>
                <div>
                    <div class="text-secondary small">Ticket promedio</div>
                    <div class="h4 mb-0">Bs <?= number_format((float)($resumen['promedio'] ?? 0), 2) ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="mb-3">Productos más vendidos</h6>
                <canvas id="chartVendidos" height="280"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="mb-3">Productos con menor stock</h6>
                <canvas id="chartStock" height="280"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="<?= asset('styles/js/chart.umd.min.js') ?>"></script>
<script>
const colores = ['#0d6efd', '#6f42c1', '#d63384', '#fd7e14', '#198754'];

// Productos mas vendidos (barras horizontales)
const nombresVendidos = <?= json_encode(array_column($masVendidos, 'nombre')) ?>;
const cantidades     = <?= json_encode(array_map(fn($p) => (int)$p['total_vendido'], $masVendidos)) ?>;

new Chart(document.getElementById('chartVendidos'), {
    type: 'bar',
    data: {
        labels: nombresVendidos,
        datasets: [{
            label: 'Unidades vendidas',
            data: cantidades,
            backgroundColor: colores,
            borderRadius: 6
        }]
    },
    options: {
        indexAxis: 'y',
        plugins: { legend: { display: false } },
        scales: { x: { beginAtZero: true, ticks: { precision: 0 } } }
    }
});

// Productos con menor stock (pastel)
const nombresStock = <?= json_encode(array_column($menorStock, 'nombre')) ?>;
const stockActual  = <?= json_encode(array_map(fn($p) => (int)$p['stock'], $menorStock)) ?>;

new Chart(document.getElementById('chartStock'), {
    type: 'doughnut',
    data: {
        labels: nombresStock.map((n, i) => n + ' (' + stockActual[i] + ')'),
        datasets: [{
            data: stockActual,
            backgroundColor: ['#dc3545', '#fd7e14', '#ffc107', '#0dcaf0', '#198754'],
            borderWidth: 2
        }]
    },
    options: { plugins: { legend: { position: 'bottom' } } }
});
</script>
<?php layout_foot(); ?>