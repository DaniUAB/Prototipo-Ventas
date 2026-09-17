<?php
require_once __DIR__ . '/BaseModel.php';

class Usuario extends BaseModel {
    protected $table = 'usuarios';

    public function create($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['nombre'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['rol'] ?? 'vendedor'
        ]);
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}