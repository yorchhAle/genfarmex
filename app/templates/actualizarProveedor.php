<?php
// Incluir el controlador de proveedores
require_once '../controllers/controladorProveedor.php';

// Crear una instancia del controlador de proveedores
$proveedorController = new ProveedorController();

// Verificar si se ha recibido un ID de proveedor válido a través de la URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener el ID del proveedor desde la URL
    $idProveedor = $_GET['id'];

    // Obtener los detalles del proveedor por su ID
    $proveedor = $proveedorController->obtenerProveedorPorId($idProveedor);

    // Verificar si se ha enviado un formulario con el método POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recibir los datos enviados a través del formulario
        $nombre = $_POST['nombre'];
        $contacto = $_POST['contacto'];
        $telefono = $_POST['telefono'];
        $email = $_POST['correo'];
        $direccion = $_POST['direccion'];

        // Llamar al método para actualizar el proveedor en la base de datos
        $actualizacionExitosa = $proveedorController->actualizarProveedor($idProveedor, $nombre, $contacto, $telefono, $email, $direccion);

        // Mostrar mensaje de éxito o error dependiendo de la actualización
        if ($actualizacionExitosa) {
            $mensaje = "Proveedor actualizado correctamente.";
            $tipoMensaje = "success"; // Tipo de mensaje para mostrar en el alert
        } else {
            $mensaje = "Error al actualizar el proveedor.";
            $tipoMensaje = "error";
        }

        // Mostrar el mensaje y redirigir a la página de lista de proveedores
        echo "<script>
                alert('$mensaje');
                window.location.href = 'listarProveedores.php'; // Redirigir a la lista de proveedores
              </script>";
        exit; // Terminar el script después de redirigir
    }
} else {
    // Si no se encuentra el ID del proveedor, redirigir a la lista de proveedores
    header("Location: listarProveedores.php");
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
    <link rel="stylesheet" href="../static/css/update.css"> <!-- Estilo para la página de actualización -->
</head>

<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú de navegación -->

    <h2 align="center">Actualizar Proveedor</h2>

    <div class="form-container">
        <?php if ($proveedor): ?> <!-- Verificar si el proveedor fue encontrado -->
            <!-- Formulario para actualizar los datos del proveedor -->
            <form method="POST" action="actualizarProveedor.php?id=<?php echo $idProveedor; ?>"> <!-- El ID se pasa en la URL -->

                <!-- Campo para el nombre del proveedor -->
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($proveedor['nombreP']); ?>" required>

                <!-- Campo para el contacto del proveedor -->
                <label for="contacto">Contacto:</label>
                <input type="text" name="contacto" id="contacto" value="<?php echo htmlspecialchars($proveedor['contactoP']); ?>" required>

                <!-- Campo para el teléfono del proveedor -->
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" value="<?php echo htmlspecialchars($proveedor['telefonoP']); ?>" required>

                <!-- Campo para el correo electrónico del proveedor -->
                <label for="correo">Correo Electrónico:</label>
                <input type="email" name="correo" id="correo" value="<?php echo htmlspecialchars($proveedor['correoP']); ?>" required>

                <!-- Campo para la dirección del proveedor -->
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" id="direccion" value="<?php echo htmlspecialchars($proveedor['direccionP']); ?>" required>

                <!-- Botón para enviar el formulario -->
                <button type="submit" class="btn-submit">Actualizar Proveedor</button>
            </form>
        <?php else: ?>
            <!-- Mensaje en caso de que no se encuentre el proveedor -->
            <p>No se encontró el proveedor.</p>
        <?php endif; ?>
    </div>
</body>

</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->