<?php
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Permiso.php';

class PermisoController {
    private $usuario, $permiso;

    public function __construct() {
        $this->usuario = new Usuario();
        $this->permiso = new Permiso();
    }

    public function index() {
        require_admin();
        $usuarios = $this->usuario->all();
        require __DIR__ . '/../views/permisos/index.php';
    }

    public function editar() {
        require_admin();

        $id = $_GET['id'] ?? 0;
        $usuario = $this->usuario->find($id);

        if (!$usuario) {
            header('Location: ' . url('index.php?c=permiso&a=index'));
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->permiso->asignar($id, $_POST['permisos'] ?? []);
            header('Location: ' . url('index.php?c=permiso&a=index'));
            exit;
        }

        $permisos  = $this->permiso->allOrdenado();
        $asignados = $this->permiso->idsDeUsuario($id);
        require __DIR__ . '/../views/permisos/form.php';
    }
}