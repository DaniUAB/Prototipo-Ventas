<?php
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Categoria.php';

class ProductoController {
    private $model, $categoria;

    public function __construct() {
        $this->model = new Producto();
        $this->categoria = new Categoria();
    }

    public function index() {
        $productos = $this->model->allWithCategoria();
        require __DIR__ . '/../views/productos/index.php';
    }

    public function ver() {
        $id = $_GET['id'] ?? 0;
        $producto = $this->model->find($id);
        require __DIR__ . '/../views/productos/ver.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
            header("Location: index.php?c=producto&a=index");
            exit;
        }
        $categorias = $this->categoria->all();
        require __DIR__ . '/../views/productos/form.php';
    }

    public function editar() {
        $id = $_GET['id'] ?? 0;
        $producto = $this->model->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            header("Location: index.php?c=producto&a=index");
            exit;
        }
        $categorias = $this->categoria->all();
        require __DIR__ . '/../views/productos/form.php';
    }

    public function eliminar() {
        $id = $_GET['id'] ?? $_POST['id'] ?? 0;
        $this->model->delete($id);
        header("Location: index.php?c=producto&a=index");
        exit;
    }
}