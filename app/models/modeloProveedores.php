<?php
require_once __DIR__ . '../../../config/db.php';

class ModeloProveedores {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    public function validarExistencia($telefono, $email, $direccion) {
        $sql = "SELECT * FROM proveedores WHERE telefonoP = ? OR correoP = ? OR direccionP = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $telefono, $email, $direccion);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0; // Retorna true si existe, false si no
    }

    // Crear un proveedor
    public function crearProveedor($nombre, $contacto, $telefono, $email, $direccion) {
        $sql = "INSERT INTO proveedores (nombreP, contactoP, telefonoP, correoP, direccionP) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $contacto, $telefono, $email, $direccion);
        return $stmt->execute();
    }

    // Leer todos los proveedores
    public function obtenerProveedores() {
        $sql = "SELECT idProveedores, nombreP, contactoP, telefonoP, correoP, direccionP FROM proveedores";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Actualizar un proveedor
    public function obtenerProveedorPorId($idProveedores) {
        $sql = "SELECT * FROM proveedores WHERE idProveedores = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idProveedores);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function actualizarProveedor($id, $nombre, $contacto, $telefono, $email, $direccion) {

        // Consulta para actualizar los datos
        $sql = "UPDATE proveedores SET nombreP = ?, contactoP = ?, telefonoP = ?, correoP = ?, direccionP = ? WHERE idProveedores = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("sssssi", $nombre, $contacto, $telefono, $email, $direccion, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Eliminar un proveedor
    public function eliminarProveedor($idProveedor) {
        $sql = "DELETE FROM proveedores WHERE idProveedores = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idProveedor);
        return $stmt->execute();
    }
}
?>