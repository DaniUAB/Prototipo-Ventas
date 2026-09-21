<?php
require_once __DIR__ . '/BaseModel.php';

class Producto extends BaseModel {
    protected $table = 'productos';

    public function allWithCategoria() {
        $sql = "SELECT p.*, c.nombre AS categoria 
                FROM productos p 
                JOIN categorias c ON c.id = p.categoria_id 
                ORDER BY p.id DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function create($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO productos (categoria_id, nombre, precio, stock) VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['categoria_id'], $data['nombre'],
            $data['precio'], $data['stock']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare(
            "UPDATE productos SET categoria_id=?, nombre=?, precio=?, stock=? WHERE id=?"
        );
        return $stmt->execute([
            $data['categoria_id'], $data['nombre'],
            $data['precio'], $data['stock'], $id
        ]);
    }

    // Productos con más cantidad vendida (top para el dashboard)
    public function masVendidos($limite = 5) {
        $sql = "SELECT p.id, p.nombre, SUM(d.cantidad) AS total_vendido
                FROM venta_detalle d
                JOIN productos p ON p.id = d.producto_id
                GROUP BY p.id, p.nombre
                ORDER BY total_vendido DESC
                LIMIT " . (int)$limite;
        return $this->db->query($sql)->fetchAll();
    }

    // Productos con menos stock (bajo de inventario para el dashboard)
    public function menorStock($limite = 5) {
        $sql = "SELECT id, nombre, stock
                FROM productos
                ORDER BY stock ASC
                LIMIT " . (int)$limite;
        return $this->db->query($sql)->fetchAll();
    }
}