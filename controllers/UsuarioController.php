<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    private $model;

    public function __construct() {
        $this->model = new Usuario();
    }

    public function index() {
        $usuarios = $this->model->all();
        require __DIR__ . '/../views/usuarios/index.php';
    }

    public function ver() {
        $id = $_GET['id'] ?? 0;
        $usuario = $this->model->find($id);
        require __DIR__ . '/../views/usuarios/ver.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
            flash('success', 'Usuario creado correctamente');
            header("Location: index.php?c=usuario&a=index");
            exit;
        }
        require __DIR__ . '/../views/usuarios/form.php';
    }

    public function editar() {
        $id = $_GET['id'] ?? 0;
        $usuario = $this->model->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            flash('success', 'Usuario actualizado correctamente');
            header("Location: index.php?c=usuario&a=index");
            exit;
        }
        require __DIR__ . '/../views/usuarios/form.php';
    }

    public function eliminar() {
        $id = $_GET['id'] ?? $_POST['id'] ?? 0;
        $this->model->delete($id);
        flash('success', 'Usuario eliminado correctamente');
        header("Location: index.php?c=usuario&a=index");
        exit;
    }
}