<?php
require_once __DIR__ . '/../models/Categoria.php';

class CategoriaController {
    private $model;

    public function __construct() {
        $this->model = new Categoria();
    }

    public function index() {
        $categorias = $this->model->all();
        require __DIR__ . '/../views/categorias/index.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
            header("Location: index.php?c=categoria&a=index");
            exit;
        }
        require __DIR__ . '/../views/categorias/form.php';
    }

    public function eliminar() {
        $id = $_GET['id'] ?? 0;
        $this->model->delete($id);
        header("Location: index.php?c=categoria&a=index");
    }
}