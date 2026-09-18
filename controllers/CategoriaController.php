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

    public function ver() {
        $id = $_GET['id'] ?? 0;
        $categoria = $this->model->find($id);
        require __DIR__ . '/../views/categorias/ver.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
            flash('success', 'Categoría creada correctamente');
            header("Location: index.php?c=categoria&a=index");
            exit;
        }
        require __DIR__ . '/../views/categorias/form.php';
    }

    public function editar() {
        $id = $_GET['id'] ?? 0;
        $categoria = $this->model->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            flash('success', 'Categoría actualizada correctamente');
            header("Location: index.php?c=categoria&a=index");
            exit;
        }
        require __DIR__ . '/../views/categorias/form.php';
    }

    public function eliminar() {
        $id = $_GET['id'] ?? $_POST['id'] ?? 0;
        $this->model->delete($id);
        flash('success', 'Categoría eliminada correctamente');
        header("Location: index.php?c=categoria&a=index");
        exit;
    }
}