<?php
require_once __DIR__ . '../../../config/db.php';

class ModeloPed {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    // Crear un Pedido
    public function crearPed($idCliente) {
        $sql = "INSERT INTO pedido (fechaPedido, estado, idcliente) VALUES (NOW(), 'activo', ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idCliente);
        $stmt->execute();
        return $stmt->insert_id;
    }
    

    //confirmar pedido
    public function confirmarPed($idPedido) {
        $sql = "UPDATE pedido SET estado = 'confirmado' WHERE idpedido = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }
    
        $stmt->bind_param("i", $idPedido);
    
        $resultado = $stmt->execute();
        $stmt->close();
    
        return $resultado;
    }

    // Leer todos los detallePedido
    public function obtenerPed($pedido) {
        $sql = "SELECT * FROM detallepedido WHERE idpedido = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }

        $stmt->bind_param("i", $pedido);

        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result === false) {
            die("Error al obtener los resultados: " . $stmt->error);
        }

        $detalles = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $detalles;
    }

    //para obtener el pedido activo del cliente
    public function obtenerPedidoActivoPorCliente($idCliente) {
        $sql = "SELECT * FROM pedido WHERE idcliente = ? AND estado = 'activo' LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idCliente);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
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
