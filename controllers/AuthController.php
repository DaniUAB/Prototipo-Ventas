<?php
require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    private $model;

    public function __construct() {
        $this->model = new Usuario();
    }

    public function index() {
        if (auth_check()) {
            header('Location: ' . url('index.php'));
            exit;
        }
        require __DIR__ . '/../views/auth/login.php';
    }

    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . url('index.php?c=auth&a=index'));
            exit;
        }

        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $usuario = $this->model->verify($email, $password);

        if ($usuario) {
            $_SESSION['usuario_id']     = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_rol']    = $usuario['rol'];
            header('Location: ' . url('index.php'));
            exit;
        }

        $error = 'Correo o contraseña incorrectos';
        require __DIR__ . '/../views/auth/login.php';
    }

    public function salir() {
        $_SESSION = [];
        session_destroy();
        header('Location: ' . url('index.php?c=auth&a=index'));
        exit;
    }
}