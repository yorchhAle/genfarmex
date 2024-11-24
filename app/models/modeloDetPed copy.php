<?php
require_once __DIR__ . '../../../config/db.php';
require_once '../models/modeloProductos.php';

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
        return $detalles;
    }
    
    //obtener el detalle por id
    public function obtenerDetPedPorID($idDetPed){
        $sql = "Select * from detallepedido WHERE iddetallePedido = ?";
        $stmt = $this->conn->prepare($sql);

        if($stmt === false){
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }

        $stmt->bind_param("i",$idDetPed);
        
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }
    
        // Obtenemos los resultados
        $result = $stmt->get_result();
    
        if ($result === false) {
            die("Error al obtener los resultados: " . $stmt->error);
        }
    
        // Convertimos los resultados a un arreglo asociativo
        $detalles = $result->fetch_assoc();
        $stmt->close();
        
        return $detalles;
    }

    // Actualizar un detallePedido
    public function actualizarDetPed($iddetallepedido, $cantidad,$idProd) {
        $detalleActual = $this->obtenerDetPedPorID($iddetallepedido);
        $modeloProducto = new ModeloProductos();
        $producto = $modeloProducto->obtenerProductoPorId($idProd);
        $oldCanti = $detalleActual['cantidad'];

            if($cantidad > $oldCanti){
                $nuevaCanti = $cantidad - $oldCanti;
                $sql = "UPDATE detallePedido SET cantidad = ? WHERE iddetallepedido = ?";
            $stmt = $this->conn->prepare($sql);

            if ($stmt === false) {
                die("Error en la preparación de la consulta: " . $this->conn->error);
            }

            $stmt->bind_param("ii", $cantidad, $iddetallepedido);

            $resultado = $stmt->execute();
            $stmt->close();

            $modeloProducto->reducirExistencias($idProd,$nuevaCanti);
            header("location:carrito.php");
        }else{
            if($cantidad === '0'){
                $this->eliminarDetPed($iddetallepedido, $idProd);
                header("location:carrito.php");
            }else{
                if($cantidad === $oldCanti){
                    header("location:carrito.php");
                }else{
                    $sql = "UPDATE detallePedido SET cantidad = ? WHERE iddetallepedido = ?";
                    $stmt = $this->conn->prepare($sql);
                    if ($stmt === false) {
                        die("Error en la preparación de la consulta: " . $this->conn->error);
                    }

                    $stmt->bind_param("ii", $cantidad, $iddetallepedido);

                    $resultado = $stmt->execute();
                    $stmt->close();
                    $cantidadN = $oldCanti - $cantidad;
                    $modeloProducto->aumentarExistencias($idProd,$cantidadN);
                    header("location:carrito.php");
                }
            }
        }

        

        return $resultado;
    }

    // Eliminar un detallePedido
    public function eliminarDetPed($idDetallePedido, $idProducto) {
        // Obtener la cantidad asociada al detalle eliminado
        $sql = "SELECT cantidad FROM detallepedido WHERE iddetallePedido = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }
    
        $stmt->bind_param("i", $idDetallePedido);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
    
        if (!$row) {
            die("No se encontró el detalle del pedido con id: " . $idDetallePedido);
        }
    
        $canti = $row['cantidad']; // La cantidad obtenida

        // Eliminar detalle del pedido
        $sql = "DELETE FROM detallepedido WHERE iddetallePedido = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }
    
        $stmt->bind_param("i", $idDetallePedido);
        $resultado = $stmt->execute();
        $stmt->close();
    
        if (!$resultado) {
            die("Error al eliminar el detalle del pedido: " . $this->conn->error);
        }
    
        // Actualizar las existencias del producto
        $sql = "UPDATE producto SET existencias = existencias + ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }
    
        $stmt->bind_param("ii", $canti, $idProducto);
        $stmt->execute();
    
        if (!$stmt) {
            die("Error al actualizar las existencias: " . $this->conn->error);
        }
    
        $stmt->close();
    }
    
}
?>
