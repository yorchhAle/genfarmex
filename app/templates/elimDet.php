<?php 
    require_once '../../config/db.php'; // Archivo de conexión a la base de datos
    $conn = getConnection();
    require_once '../models/modeloDetPed.php'; // Modelo para manejar detalles del pedido
    
    $modeloDetallePedido = new ModeloDetPed();

    $idDetPed = $_GET['id'];
    $idProducto = $_GET['idProd'];

    if($modeloDetallePedido->eliminarDetPed($idDetPed, $idProducto)){?>
    <script>
        alert("El producto fue eliminado correctamente");
    </script>
    <?php }else{?>
    <script>
        alert("El producto no pudo ser eliminado correctamente");
    </script>
    <?php }
    header("Location:carrito.php");
?>