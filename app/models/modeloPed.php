<?php
require_once __DIR__ . '../../../config/db.php';

class ModeloDetPed {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    // Crear un detallePedido
    public function crearDetPed($canti, $pre, $idPed, $id) {
        $sql = "INSERT INTO detallepedido (cantidad, precioUnitario, idPedido, id) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }

        $stmt->bind_param("ifii", $canti, $pre, $idPed, $id);

        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }

    // Leer todos los detallePedido
    public function obtenerDetPed($pedido) {
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
