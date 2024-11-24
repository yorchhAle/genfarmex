<?php
require_once __DIR__ . '../../../config/db.php';

class Usuario {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    public function obtenerPorUsuario($usuario) {
        $sql = "SELECT usuario, pass, tipoUsuario FROM usuarios WHERE usuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
