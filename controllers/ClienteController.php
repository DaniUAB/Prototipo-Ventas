<?php
require_once __DIR__ . '/../models/Cliente.php';

class ClienteController {
    private $model;

    public function __construct() {
        $this->model = new Cliente();
    }

    public function index() {
        $clientes = $this->model->all();
        require __DIR__ . '/../views/clientes/index.php';
    }

    public function ver() {
        $id = $_GET['id'] ?? 0;
        $cliente = $this->model->find($id);
        require __DIR__ . '/../views/clientes/ver.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
            header("Location: index.php?c=cliente&a=index");
            exit;
        }
        require __DIR__ . '/../views/clientes/form.php';
    }

    public function editar() {
        $id = $_GET['id'] ?? 0;
        $cliente = $this->model->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            header("Location: index.php?c=cliente&a=index");
            exit;
        }
        require __DIR__ . '/../views/clientes/form.php';
    }

    public function eliminar() {
        $id = $_GET['id'] ?? $_POST['id'] ?? 0;
        $this->model->delete($id);
        header("Location: index.php?c=cliente&a=index");
        exit;
    }
}