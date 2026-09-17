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

    public function update($id, $data) {
        if (!empty($data['password'])) {
            $stmt = $this->db->prepare(
                "UPDATE usuarios SET nombre = ?, email = ?, password = ?, rol = ? WHERE id = ?"
            );
            return $stmt->execute([
                $data['nombre'],
                $data['email'],
                password_hash($data['password'], PASSWORD_DEFAULT),
                $data['rol'] ?? 'vendedor',
                $id
            ]);
        }
        $stmt = $this->db->prepare(
            "UPDATE usuarios SET nombre = ?, email = ?, rol = ? WHERE id = ?"
        );
        return $stmt->execute([
            $data['nombre'],
            $data['email'],
            $data['rol'] ?? 'vendedor',
            $id
        ]);
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function verify($email, $password) {
        $usuario = $this->findByEmail($email);
        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }
        return false;
    }
}