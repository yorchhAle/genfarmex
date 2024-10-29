<?php
require_once __DIR__ . '../../../config/db.php';

class ModeloDescuentos {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    // Crear un descuento
    public function crearDescuento($nombre, $porcentaje, $fechaCreacion) {
        $sql = "INSERT INTO descuentos (nombre, porcentaje, FechaCreacion) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sds", $nombre, $porcentaje, $fechaCreacion);
        return $stmt->execute();
    }

    // Leer todos los descuentos
    public function obtenerDescuentos() {
        $sql = "SELECT * FROM descuentos";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Actualizar un descuento
    public function actualizarDescuento($idDescuento, $nombre, $porcentaje, $fechaCreacion) {
        $sql = "UPDATE descuentos SET nombre = ?, porcentaje = ?, FechaCreacion = ? WHERE idDecuentos = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdsi", $nombre, $porcentaje, $fechaCreacion, $idDescuento);
        return $stmt->execute();
    }

    // Eliminar un descuento
    public function eliminarDescuento($idDescuento) {
        $sql = "DELETE FROM descuentos WHERE idDecuentos = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idDescuento);
        return $stmt->execute();
    }
}
?>
