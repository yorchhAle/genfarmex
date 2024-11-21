<?php
require_once '../controllers/controladorProveedor.php';
$proveedorController = new ProveedorController();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idProveedor = $_GET['id']; // Obtener el ID del proveedor
    $proveedor = $proveedorController->obtenerProveedorPorId($idProveedor); // Obtener proveedor por ID

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recibir los datos del formulario
        $nombre = $_POST['nombre'];
        $contacto = $_POST['contacto'];
        $telefono = $_POST['telefono'];
        $email = $_POST['correo'];
        $direccion = $_POST['direccion'];

        // Llamar al controlador para actualizar el proveedor
        $actualizacionExitosa = $proveedorController->actualizarProveedor($idProveedor, $nombre, $contacto, $telefono, $email, $direccion);
        
        if ($actualizacionExitosa) {
            $mensaje = "Proveedor actualizado correctamente.";
            $tipoMensaje = "success"; // Establecer un tipo de mensaje para mostrarlo con estilo
        } else {
            $mensaje = "Error al actualizar el proveedor.";
            $tipoMensaje = "error";
        }

        // Mostrar el mensaje y redirigir
        echo "<script>
                alert('$mensaje');
                window.location.href = 'listarProveedores.php'; // Redirigir a la lista de proveedores
              </script>";
        exit;
    }
} else {
    header("Location: listarProveedores.php"); // Redirigir si no se encuentra el ID
    exit;
}
?>

<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Proveedor</title>
    <link rel="stylesheet" href="../static/css/update.css">
</head>
<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->
    <h2 align="center">Actualizar Proveedor</h2>

    <div class="form-container">
        <?php if ($proveedor): ?>
            <form method="POST" action="actualizarProveedor.php?id=<?php echo $idProveedor; ?>"> <!-- Agregar el ID en la URL -->
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($proveedor['nombreP']); ?>" required>

                <label for="contacto">Contacto:</label>
                <input type="text" name="contacto" id="contacto" value="<?php echo htmlspecialchars($proveedor['contactoP']); ?>" required>

                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" value="<?php echo htmlspecialchars($proveedor['telefonoP']); ?>" required>

                <label for="correo">Correo Electrónico:</label>
                <input type="email" name="correo" id="correo" value="<?php echo htmlspecialchars($proveedor['correoP']); ?>" required>

                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" id="direccion" value="<?php echo htmlspecialchars($proveedor['direccionP']); ?>" required>

                <button type="submit" class="btn-submit">Actualizar Proveedor</button>
            </form>
        <?php else: ?>
            <p>No se encontró el proveedor.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
