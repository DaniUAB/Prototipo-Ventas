<?php
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Categoria.php';
require_once __DIR__ . '/../config/validacion.php';

class ProductoController {
    private $producto, $categoria;

    public function __construct() {
        $this->producto  = new Producto();
        $this->categoria = new Categoria();
    }

    public function index() {
        $productos = $this->producto->allWithCategoria();
        require __DIR__ . '/../views/productos/index.php';
    }

    public function ver() {
        $id = $_GET['id'] ?? 0;
        $producto = $this->producto->find($id);
        require __DIR__ . '/../views/productos/ver.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errores = validar_requeridos($_POST, [
                'nombre'       => 'Nombre',
                'categoria_id' => 'Categoría',
                'precio'       => 'Precio',
                'stock'        => 'Stock'
            ]);
            $errores = array_merge($errores, validar_minimo($_POST, [
                'precio' => ['etiqueta' => 'Precio', 'min' => 0],
                'stock'  => ['etiqueta' => 'Stock',  'min' => 0]
            ]));

            if ($errores) {
                $item  = $_POST;
                $error = error_formulario($errores);
                require __DIR__ . '/../views/productos/form.php';
                return;
            }
            $this->producto->create($_POST);
            flash('success', 'Producto creado correctamente');
            header("Location: index.php?c=producto&a=index");
            exit;
        }
        require __DIR__ . '/../views/productos/form.php';
    }

    public function editar() {
        $id = $_GET['id'] ?? 0;
        $producto = $this->producto->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errores = validar_requeridos($_POST, [
                'nombre'       => 'Nombre',
                'categoria_id' => 'Categoría',
                'precio'       => 'Precio',
                'stock'        => 'Stock'
            ]);
            $errores = array_merge($errores, validar_minimo($_POST, [
                'precio' => ['etiqueta' => 'Precio', 'min' => 0],
                'stock'  => ['etiqueta' => 'Stock',  'min' => 0]
            ]));

            if ($errores) {
                $item  = $_POST;
                $error = error_formulario($errores);
                require __DIR__ . '/../views/productos/form.php';
                return;
            }
            $this->producto->update($id, $_POST);
            flash('success', 'Producto actualizado correctamente');
            header("Location: index.php?c=producto&a=index");
            exit;
        }
        require __DIR__ . '/../views/productos/form.php';
    }

    public function eliminar() {
        $id = $_GET['id'] ?? $_POST['id'] ?? 0;
        $this->producto->delete($id);
        flash('success', 'Producto eliminado correctamente');
        header("Location: index.php?c=producto&a=index");
        exit;
    }
}
