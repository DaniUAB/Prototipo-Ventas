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

    public function ver() {
        $id = $_GET['id'] ?? 0;
        $venta   = $this->venta->find($id);
        $detalle = $this->venta->detalle($id);
        require __DIR__ . '/../views/ventas/ver.php';
    }

    public function crear() {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productos  = $_POST['producto_id'] ?? [];
            $cantidades = $_POST['cantidad'] ?? [];

            if (!is_array($productos)) {
                $productos = [$productos];
            }
            if (!is_array($cantidades)) {
                $cantidades = [$cantidades];
            }

            $items = [];
            foreach ($productos as $i => $pid) {
                $cantidad = (int)($cantidades[$i] ?? 0);
                if (!empty($pid) && $cantidad > 0) {
                    $items[] = [
                        'producto_id' => (int)$pid,
                        'cantidad'    => $cantidad
                    ];
                }
            }

            $usuario_id = !empty($_POST['usuario_id'])
                ? (int)$_POST['usuario_id']
                : (int)($_SESSION['usuario_id'] ?? 0);

            try {
                $this->venta->registrar(
                    (int)($_POST['cliente_id'] ?? 0),
                    $usuario_id,
                    $items
                );
                header("Location: index.php?c=venta&a=index");
                exit;
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        $clientes  = $this->cliente->all();
        $productos = $this->producto->allWithCategoria();
        require __DIR__ . '/../views/ventas/form.php';
    }

    public function eliminar() {
        $id = $_GET['id'] ?? $_POST['id'] ?? 0;
        try {
            $this->venta->delete($id);
        } catch (Exception $e) {
            die("Error al anular la venta: " . $e->getMessage());
        }
        header("Location: index.php?c=venta&a=index");
        exit;
    }
}