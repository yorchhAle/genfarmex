<?php
// Incluir archivo de configuración para establecer la conexión a la base de datos
require_once __DIR__ . '../../../config/db.php';

class ModeloProveedores {
    private $conn; // Variable para almacenar la conexión a la base de datos

    // Constructor de la clase, que establece la conexión a la base de datos
    public function __construct() {
        $this->conn = getConnection(); // Obtiene la conexión a la base de datos
    }

    // Método para validar la existencia de un proveedor con el mismo teléfono, correo o dirección
    public function validarExistencia($telefono, $email, $direccion) {
        // Consulta SQL para verificar si ya existe un proveedor con los mismos datos
        $sql = "SELECT * FROM proveedores WHERE telefonoP = ? OR correoP = ? OR direccionP = ?";
        
        // Preparar la consulta
        $stmt = $this->conn->prepare($sql);
        
        // Vincular los parámetros a la consulta
        $stmt->bind_param("sss", $telefono, $email, $direccion);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener el resultado de la consulta
        $result = $stmt->get_result();
        
        // Si se encuentra al menos un resultado, devuelve true (ya existe), si no, false
        return $result->num_rows > 0;
    }

    // Método para crear un proveedor
    public function crearProveedor($nombre, $contacto, $telefono, $email, $direccion) {
        // Consulta SQL para insertar un nuevo proveedor
        $sql = "INSERT INTO proveedores (nombreP, contactoP, telefonoP, correoP, direccionP) VALUES (?, ?, ?, ?, ?)";
        
        // Preparar la consulta
        $stmt = $this->conn->prepare($sql);
        
        // Vincular los parámetros a la consulta
        $stmt->bind_param("sssss", $nombre, $contacto, $telefono, $email, $direccion);
        
        // Ejecutar la consulta e insertar el proveedor en la base de datos
        return $stmt->execute();
    }

    // Método para obtener todos los proveedores
    public function obtenerProveedores() {
        // Consulta SQL para obtener todos los proveedores
        $sql = "SELECT idProveedores, nombreP, contactoP, telefonoP, correoP, direccionP FROM proveedores";
        
        // Ejecutar la consulta
        $result = $this->conn->query($sql);
        
        // Devolver el resultado como un arreglo asociativo
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Método para obtener los detalles de un proveedor por su ID
    public function obtenerProveedorPorId($idProveedores) {
        // Consulta SQL para obtener un proveedor por su ID
        $sql = "SELECT * FROM proveedores WHERE idProveedores = ?";
        
        // Preparar la consulta
        $stmt = $this->conn->prepare($sql);
        
        // Vincular el parámetro (ID del proveedor) a la consulta
        $stmt->bind_param("i", $idProveedores);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener el resultado de la consulta
        $result = $stmt->get_result();
        
        // Devolver el resultado como un arreglo asociativo (único proveedor)
        return $result->fetch_assoc();
    }
    
    // Método para actualizar los datos de un proveedor
    public function actualizarProveedor($id, $nombre, $contacto, $telefono, $email, $direccion) {
        // Consulta SQL para actualizar los datos del proveedor
        $sql = "UPDATE proveedores SET nombreP = ?, contactoP = ?, telefonoP = ?, correoP = ?, direccionP = ? WHERE idProveedores = ?";
        
        // Preparar la consulta
        $stmt = $this->conn->prepare($sql);
        
        // Vincular los parámetros a la consulta (datos del proveedor y su ID)
        $stmt->bind_param("sssssi", $nombre, $contacto, $telefono, $email, $direccion, $id);

        // Ejecutar la consulta y devolver true si la actualización fue exitosa
        if ($stmt->execute()) {
            return true;
        } else {
            return false; // Si algo falla, devuelve false
        }
    }

    // Método para eliminar un proveedor
    public function eliminarProveedor($idProveedor) {
        // Consulta SQL para eliminar un proveedor
        $sql = "DELETE FROM proveedores WHERE idProveedores = ?";
        
        // Preparar la consulta
        $stmt = $this->conn->prepare($sql);
        
        // Vincular el parámetro (ID del proveedor) a la consulta
        $stmt->bind_param("i", $idProveedor);
        
        // Ejecutar la consulta para eliminar al proveedor
        return $stmt->execute();
    }
}
?>
