<?php
require_once __DIR__ . '/BaseModel.php';

class Cliente extends BaseModel {
    protected $table = 'clientes';

    public function create($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO clientes (nombre, documento, telefono, email, direccion)
             VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['nombre'], $data['documento'], $data['telefono'],
            $data['email'], $data['direccion']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare(
            "UPDATE clientes SET nombre=?, documento=?, telefono=?, email=?, direccion=? WHERE id=?"
        );
        return $stmt->execute([
            $data['nombre'], $data['documento'], $data['telefono'],
            $data['email'], $data['direccion'], $id
        ]);
    }
}