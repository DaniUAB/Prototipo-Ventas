<?php
require_once __DIR__ . '/../models/Venta.php';
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Producto.php';

class VentaController {
    private $venta, $cliente, $producto;

    public function __construct() {
        $this->venta    = new Venta();
        $this->cliente  = new Cliente();
        $this->producto = new Producto();
    }

    public function index() {
        $ventas = $this->venta->allWithRelations();
        require __DIR__ . '/../views/ventas/index.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $items = [];
            foreach ($_POST['producto_id'] as $i => $pid) {
                if (!empty($pid) && $_POST['cantidad'][$i] > 0) {
                    $items[] = [
                        'producto_id' => (int)$pid,
                        'cantidad'    => (int)$_POST['cantidad'][$i]
                    ];
                }
            }
            try {
                $this->venta->registrar(
                    (int)$_POST['cliente_id'],
                    (int)$_SESSION['usuario_id'], // asume login
                    $items
                );
                header("Location: index.php?c=venta&a=index");
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
        $clientes   = $this->cliente->all();
        $productos  = $this->producto->allWithCategoria();
        require __DIR__ . '/../views/ventas/form.php';
    }

    public function detalle() {
        $id = $_GET['id'] ?? 0;
        $venta   = $this->venta->find($id);
        $detalle = $this->venta->detalle($id);
        require __DIR__ . '/../views/ventas/detalle.php';
    }
}