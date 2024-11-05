<?php
require_once __DIR__ . '../../../config/db.php';

class ModeloProveedores {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    // Crear un proveedor
    public function crearProveedor($nombre, $contacto,$telefono,$email,$direccion) {
        $sql = "INSERT INTO proveedores (nombreP, contactoP, telefonoP, correoP, direccionP) VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $contacto, $telefono, $email, $direccion);
        return $stmt->execute();
    }

    // Leer todos los proveedores
    public function obtenerProveedores() {
        $sql = "SELECT * FROM proveedores";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Actualizar un proveedores
    public function actualizarProveedor($idProveedor, $nombre, $contacto,$telefono,$email,$direccion) {
        $sql = "UPDATE proveedores SET nombreP = ?, contactoP = ?, telefonoP = ?, correoP =? , direccionP = ? WHERE idProveedor = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssi", $nombre, $contacto, $telefono, $email, $direccion);
        $stmt->execute();
        return $stmt->execute();
    }

    // Eliminar un proveedor
    public function eliminarProveedor($idProveedor) {
        $sql = "DELETE FROM proveedores WHERE idproveedores = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idProveedor);
        return $stmt->execute();
    }
}
?>
