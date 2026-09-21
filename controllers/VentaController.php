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
        $detalles = [];
        foreach ($ventas as $v) {
            $detalles[$v['id']] = $this->venta->detalle($v['id']);
        }
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
            $error = null   ; // <== ESTO ROMPE TODO: borra

            foreach ($productos as $i => $pid) {
                if (empty($pid)) {
                    continue; // fila sin producto -> se ignora completa
                }
                $cantidad = isset($cantidades[$i]) && $cantidades[$i] !== '' ? (int)$cantidades[$i] : 0;

                if ($cantidad < 1) {
                    $error = "La cantidad del producto seleccionado debe ser al menos 1.";
                    break;
                }
                $items[] = [
                    'producto_id' => (int)$pid,
                    'cantidad'    => $cantidad
                ];
            }

            if (empty($items)) {
                $error = $error ?? "Agrega al menos un producto con su cantidad a la venta.";
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
                flash('success', 'Venta registrada correctamente');
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
            flash('success', 'Venta anulada correctamente');
        } catch (Exception $e) {
            flash('danger', 'Error al anular la venta: ' . $e->getMessage());
        }
        header("Location: index.php?c=venta&a=index");
        exit;
    }
}