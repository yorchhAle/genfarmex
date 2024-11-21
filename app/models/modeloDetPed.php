<?php
require_once __DIR__ . '../../../config/db.php';

class ModeloDetPed {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    // Crear un detallePedido
    public function crearDetPed($idPedido, $idProducto, $cantidad, $precioUnitario) {
        $sql = "INSERT INTO detallepedido (idpedido, id, cantidad, precioUnitario) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }
    
        $stmt->bind_param("iiid", $idPedido, $idProducto, $cantidad, $precioUnitario);
    
        $resultado = $stmt->execute();
        $stmt->close();
    
        return $resultado;
    }
    

    // Leer todos los detallePedido
    public function obtenerDetPed($pedido) {
        // Consulta para obtener detalles del pedido
        $sql = "SELECT * FROM detallepedido WHERE idpedido = ?";
    
        // Preparamos la consulta
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }
    
        // Enlazamos el parámetro del pedido
        $stmt->bind_param("i", $pedido);
    
        // Ejecutamos la consulta
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }
    
        // Obtenemos los resultados
        $result = $stmt->get_result();
    
        if ($result === false) {
            die("Error al obtener los resultados: " . $stmt->error);
        }
    
        // Convertimos los resultados a un arreglo asociativo
        $detalles = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    
        // Depuración
        if (empty($detalles)) {
            echo "No hay detalles para este pedido.";
        } 
    
        return $detalles;
    }
    

    // Actualizar un detallePedido
    public function actualizarDetPed($iddetallepedido, $cantidad) {
        $sql = "UPDATE detallePedido SET cantidad = ? WHERE iddetallepedido = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }

        $stmt->bind_param("ii", $cantidad, $iddetallepedido);

        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }

    // Eliminar un detallePedido
    public function eliminarDetPed($idDetallePedido) {
        $sql = "DELETE FROM detallepedido WHERE iddetallepedido = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }

        $stmt->bind_param("i", $idDetallePedido);

        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }
}
?>
