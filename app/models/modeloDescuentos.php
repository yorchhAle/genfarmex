<?php
// Incluir la conexión a la base de datos
require_once __DIR__ . '../../../config/db.php';

class ModeloDescuentos
{
    private $conn;

    // Constructor que obtiene la conexión a la base de datos
    public function __construct()
    {
        $this->conn = getConnection(); // Establecer conexión a la base de datos usando la función getConnection()
    }

    // Crear un descuento en la base de datos
    public function crearDescuento($nombre, $porcentaje, $fechaCreacion)
    {
        // Consulta SQL para insertar un nuevo descuento
        $sql = "INSERT INTO descuentos (nombre, porcentaje, FechaCreacion) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql); // Preparar la consulta
        $stmt->bind_param("sds", $nombre, $porcentaje, $fechaCreacion); // Vincular parámetros
        return $stmt->execute(); // Ejecutar la consulta y devolver el resultado
    }

    // Obtener todos los descuentos de la base de datos
    public function obtenerDescuentos()
    {
        // Consulta SQL para seleccionar todos los descuentos
        $sql = "SELECT * FROM descuentos";
        $result = $this->conn->query($sql); // Ejecutar la consulta
        return $result->fetch_all(MYSQLI_ASSOC); // Devolver todos los descuentos en formato de array asociativo
    }

    // Verificar si un descuento con el mismo nombre ya existe en la base de datos
    public function existeNombreDescuento($nombre)
    {
        // Consulta SQL para verificar si existe un descuento con el nombre especificado
        $sql = "SELECT COUNT(*) as total FROM descuentos WHERE nombre = ?";
        $stmt = $this->conn->prepare($sql); // Preparar la consulta
        $stmt->bind_param("s", $nombre); // Vincular el parámetro de nombre
        $stmt->execute(); // Ejecutar la consulta
        $result = $stmt->get_result()->fetch_assoc(); // Obtener el resultado de la consulta
        return $result['total'] > 0; // Retornar verdadero si existe al menos un descuento con ese nombre
    }

    // Actualizar un descuento en la base de datos
    public function actualizarDescuento($idDescuento, $nombre, $porcentaje, $fechaCreacion)
    {
        // Consulta SQL para actualizar un descuento
        $sql = "UPDATE descuentos SET nombre = ?, porcentaje = ?, FechaCreacion = ? WHERE idDecuentos = ?";
        $stmt = $this->conn->prepare($sql); // Preparar la consulta
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->conn->error); // Si la preparación falla, mostrar el error
        }
        $stmt->bind_param("sdsi", $nombre, $porcentaje, $fechaCreacion, $idDescuento); // Vincular los parámetros
        $result = $stmt->execute(); // Ejecutar la consulta
        if (!$result) {
            die("Error al ejecutar la consulta: " . $stmt->error); // Si la ejecución falla, mostrar el error
        }
        return $result; // Retornar el resultado de la ejecución
    }

    // Eliminar un descuento de la base de datos
    public function eliminarDescuento($idDescuento)
    {
        // Consulta SQL para eliminar un descuento
        $sql = "DELETE FROM descuentos WHERE idDecuentos = ?";
        $stmt = $this->conn->prepare($sql); // Preparar la consulta
        $stmt->bind_param("i", $idDescuento); // Vincular el parámetro del id del descuento
        return $stmt->execute(); // Ejecutar la consulta y devolver el resultado
    }
}
?>
