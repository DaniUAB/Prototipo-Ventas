<?php
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Venta.php';

class DashboardController {
    private $producto, $venta;

    public function __construct() {
        $this->producto = new Producto();
        $this->venta    = new Venta();
    }

    public function index() {
        $resumen        = $this->venta->resumen();
        $masVendidos    = $this->producto->masVendidos(5);
        $menorStock     = $this->producto->menorStock(5);
        $gananciasDia   = $this->venta->gananciasPorDia();
        require __DIR__ . '/../views/dashboard/index.php';
    }
}