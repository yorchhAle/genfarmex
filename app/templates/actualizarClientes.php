<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->

<?php
require_once '../controllers/controladorUs.php';

$clienteController = new UsController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $idCliente = $_POST['idCliente'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    // Actualizar el cliente
    if ($clienteController->actualizarUsuario($idCliente, $nombre, $apellido, $nombre, null, $email, $telefono, $direccion, 'cliente', [])) {
        echo "<script>alert('Cliente actualizado exitosamente.'); window.location.href='listarClientes.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el cliente.'); window.location.href='listarClientes.php';</script>";
    }
} else {
    // Obtener ID del cliente desde GET
    $idCliente = $_GET['id'];
    $clienteActual = $clienteController->obtenerUsuarios($idCliente);

    if ($clienteActual) {
?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Actualizar Cliente</title>
            <link rel="stylesheet" href="../static/css/update.css">
        </head>
        <body>
            <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->
            <h2>Actualizar Cliente</h2>
            <div class="form-container">
                
                <form action="actualizarClientes.php" method="POST">
                    <input type="hidden" name="idCliente" value="<?php echo htmlspecialchars($clienteActual['idusuario']); ?>">
                    
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($clienteActual['nombre']); ?>" required>

                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" value="<?php echo htmlspecialchars($clienteActual['apellido']); ?>" required>

                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" id="telefono" value="<?php echo htmlspecialchars($clienteActual['telefono']); ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($clienteActual['correo']); ?>" required>

                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion" id="direccion" value="<?php echo htmlspecialchars($clienteActual['direccion']); ?>" required>

                    <button type="submit" class="btn-submit">Actualizar Cliente</button>
                </form>
            </div>
        </body>
        </html>
<?php
    } else {
        echo "<p>No se encontró el cliente.</p>";
    }
}
?>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
