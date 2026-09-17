<?php
require_once __DIR__ . '/BaseModel.php';

class Categoria extends BaseModel {
    protected $table = 'categorias';

    public function create($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)"
        );
        return $stmt->execute([$data['nombre'], $data['descripcion']]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare(
            "UPDATE categorias SET nombre = ?, descripcion = ? WHERE id = ?"
        );
        return $stmt->execute([$data['nombre'], $data['descripcion'], $id]);
    }
}