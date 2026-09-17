<?php
require_once __DIR__ . '/BaseModel.php';

class Venta extends BaseModel {
    protected $table = 'ventas';

    /**
     * $items = [ ['producto_id'=>1,'cantidad'=>2], ... ]
     */
    public function registrar($cliente_id, $usuario_id, $items) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare(
                "INSERT INTO ventas (cliente_id, usuario_id, total) VALUES (?, ?, 0)"
            );
            $stmt->execute([$cliente_id, $usuario_id]);
            $venta_id = $this->db->lastInsertId();

            $total = 0;
            $detalle = $this->db->prepare(
                "INSERT INTO venta_detalle 
                 (venta_id, producto_id, cantidad, precio_unitario, subtotal) 
                 VALUES (?, ?, ?, ?, ?)"
            );
            $getPrecio = $this->db->prepare(
                "SELECT precio, stock FROM productos WHERE id = ?"
            );
            $updateStock = $this->db->prepare(
                "UPDATE productos SET stock = stock - ? WHERE id = ?"
            );

            foreach ($items as $item) {
                $getPrecio->execute([$item['producto_id']]);
                $prod = $getPrecio->fetch();

                if (!$prod || $prod['stock'] < $item['cantidad']) {
                    throw new Exception("Stock insuficiente para producto ID " . $item['producto_id']);
                }

                $subtotal = $prod['precio'] * $item['cantidad'];
                $total += $subtotal;

                $detalle->execute([
                    $venta_id, $item['producto_id'], $item['cantidad'],
                    $prod['precio'], $subtotal
                ]);
                $updateStock->execute([$item['cantidad'], $item['producto_id']]);
            }

            $this->db->prepare("UPDATE ventas SET total = ? WHERE id = ?")
                     ->execute([$total, $venta_id]);

            $this->db->commit();
            return $venta_id;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function allWithRelations() {
        $sql = "SELECT v.*, c.nombre AS cliente, u.nombre AS usuario
                FROM ventas v
                JOIN clientes c ON c.id = v.cliente_id
                JOIN usuarios u ON u.id = v.usuario_id
                ORDER BY v.id DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function detalle($venta_id) {
        $sql = "SELECT d.*, p.nombre AS producto
                FROM venta_detalle d
                JOIN productos p ON p.id = d.producto_id
                WHERE d.venta_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$venta_id]);
        return $stmt->fetchAll();
    }
}