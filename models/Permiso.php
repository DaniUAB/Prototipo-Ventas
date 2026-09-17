<?php
require_once __DIR__ . '/BaseModel.php';

class Permiso extends BaseModel {
    protected $table = 'permisos';

    public function allOrdenado() {
        return $this->db->query("SELECT * FROM permisos ORDER BY modulo, clave")->fetchAll();
    }

    public function clavesDeUsuario($usuario_id) {
        $stmt = $this->db->prepare(
            "SELECT p.clave
             FROM permisos p
             JOIN usuario_permisos up ON up.permiso_id = p.id
             WHERE up.usuario_id = ?"
        );
        $stmt->execute([$usuario_id]);
        return array_column($stmt->fetchAll(), 'clave');
    }

    public function idsDeUsuario($usuario_id) {
        $stmt = $this->db->prepare(
            "SELECT permiso_id FROM usuario_permisos WHERE usuario_id = ?"
        );
        $stmt->execute([$usuario_id]);
        return array_map('intval', array_column($stmt->fetchAll(), 'permiso_id'));
    }

    public function asignar($usuario_id, $ids) {
        try {
            $this->db->beginTransaction();

            $this->db->prepare("DELETE FROM usuario_permisos WHERE usuario_id = ?")
                     ->execute([$usuario_id]);

            $insert = $this->db->prepare(
                "INSERT INTO usuario_permisos (usuario_id, permiso_id) VALUES (?, ?)"
            );
            foreach ($ids as $permiso_id) {
                $insert->execute([$usuario_id, (int)$permiso_id]);
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}