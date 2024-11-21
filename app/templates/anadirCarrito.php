<?php
session_start();

require_once '../models/modeloProductos.php'; // Modelo para interactuar con productos
require_once '../models/modeloDetPed.php'; // Modelo para insertar detalles de pedido
require_once '../models/modeloPed.php'; // Modelo para manejar la tabla de pedidos
require_once '../../config/db.php'; // Archivo de conexión a la base de datos

$modeloProducto = new ModeloProductos();
$modeloDetallePedido = new ModeloDetPed();
$modeloPed = new ModeloPed(); // Aquí usamos modeloPed, según tu aclaración


// Validar sesión
if (!isset($_SESSION['tipoUsuario']) || ($_SESSION['tipoUsuario'] !== 'cliente' && $_SESSION['tipoUsuario'] !== 'admin')) {
    header("Location: ../views/inicioSesion.html");
    exit;
}

if (isset($_GET['id']) && isset($_GET['cantidad'])) {
    $idProducto = (int)$_GET['id'];
    $cantidad = (int)$_GET['cantidad'];
    $nomCliente = $_SESSION['usuario']; // Nombre de usuario desde la sesión

    // Conseguir el ID del cliente
    $conn = getConnection(); // Aquí obtenemos la conexión a la base de datos
    $query = "SELECT clientes.idcliente 
              FROM usuarios 
              INNER JOIN clientes ON clientes.idusuario = usuarios.idusuario 
              WHERE usuarios.usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nomCliente);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $idCliente = $row['idcliente']; // Obtener el ID del cliente
    $stmt->close();

    // Validar cantidad
    if ($cantidad > 0 && is_numeric($cantidad)) {
        // Obtener detalles del producto
        $producto = $modeloProducto->obtenerProductoPorId($idProducto);
        if ($producto) {
            $precioUnitario = $producto['precioUnitario'];
            $total = $cantidad * $precioUnitario;

            // Verificar si existe un pedido activo para el cliente
            $pedidoActivo = $modeloPed->obtenerPedidoActivoPorCliente($idCliente);

            if (!$pedidoActivo) {
                // Si no existe, crear un nuevo pedido
                $idPedido = $modeloPed->crearPed($idCliente);
            } else {
                // Si existe, usar el ID del pedido activo
                $idPedido = $pedidoActivo['idpedido'];
            }

            // Insertar en detallePedido
            $resultado = $modeloDetallePedido->crearDetPed($idPedido, $idProducto, $cantidad, $precioUnitario);

            if ($resultado) {
                $_SESSION['mensaje'] = "Producto añadido al carrito correctamente.";
            } else {
                $_SESSION['mensaje'] = "Error al añadir producto al carrito.";
            }
        } else {
            $_SESSION['mensaje'] = "Producto no encontrado.";
        }
    } else {
        $_SESSION['mensaje'] = "Cantidad no válida.";
    }

    $conn = getConnection(); // Aquí obtenemos la conexión a la base de datos
    $query = "SELECT clientes.idcliente 
              FROM usuarios 
              INNER JOIN clientes ON clientes.idusuario = usuarios.idusuario 
              WHERE usuarios.usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nomCliente);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $idCliente = $row['idcliente']; // Obtener el ID del cliente
    $stmt->close();

    $conn = getConnection();
    $query = "update producto set existencias = existencias - ? where id = ?";
    $query = $conn->prepare($query);
    $query->bind_param("ii",$cantidad, $idProducto);
    $query->execute();


    header("Location: carrito.php?idPedido=" . $idPedido);
}

// Mostrar los detalles del carrito

?>
