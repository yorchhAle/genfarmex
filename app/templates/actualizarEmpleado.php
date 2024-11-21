<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->

<?php
require_once '../controllers/controladorUs.php';
$clienteController = new UsController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = $_POST['idUsuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $tipoUsuario = $_POST['tipoUsuario'];

    $resultado = $clienteController->actualizarUsuario($idUsuario, $nombre, $apellido, $usuario, $pass, $correo, $telefono, $direccion, $tipoUsuario, [
        'fechaAlta' => $fechaAlta,
    ]);

    // Actualizar el cliente
    if ($resultado) {
        echo "<script>alert('Cliente actualizado exitosamente.'); window.location.href='listarAdmins.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el cliente.'); window.location.href='listarAdmins.php';</script>";
    }
} else {
    // Obtener ID del cliente desde GET
    $idAdmin = $_GET['id'];
    $AdminActual = $clienteController->obtenerUsuarios($idAdmin);

    if ($AdminActual) {
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
            <?php
            $idAdmin = $_GET['id'];
            if ($AdminActual) {
            ?>
                <h2 align="center">Actualizar Cliente</h2>
                <div class="form-container">
                    <form action="actualizarAdmis.php" method="POST" onsubmit="return confirmarActualizacion();">

                        <!-- Campo oculto para el idUsuario -->
                        <input type="hidden" name="idUsuario" value="<?php echo htmlspecialchars($idAdmin); ?>">

                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($AdminActual['nombre']); ?>" required>

                        <label for="apellido">Apellido:</label>
                        <input type="text" name="apellido" id="apellido" value="<?php echo htmlspecialchars($AdminActual['apellido']); ?>" required>

                        <label for="usuario">Usuario:</label>
                        <input type="text" name="usuario" id="usuario" value="<?php echo htmlspecialchars($AdminActual['usuario']); ?>" required>

                        <label for="pass">Contraseña:</label>
                        <input type="password" name="pass" id="pass" value="<?php echo htmlspecialchars($AdminActual['pass']); ?>" required>

                        <label for="correo">Correo:</label>
                        <input type="email" name="correo" id="correo" value="<?php echo htmlspecialchars($AdminActual['correo']); ?>" required>

                        <label for="telefono">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" value="<?php echo htmlspecialchars($AdminActual['telefono']); ?>" required>

                        <label for="direccion">Dirección:</label>
                        <input type="text" name="direccion" id="direccion" value="<?php echo htmlspecialchars($AdminActual['direccion']); ?>" required>

                        <label for="tipoUsuario">Tipo de Usuario:</label>
                        <select name="tipoUsuario" id="tipoUsuario" required>
                            <option value="empleado" <?php echo (isset($AdminActual['tipoUsuario']) && $AdminActual['tipoUsuario'] == 'empleado') ? 'selected' : ''; ?>>Empleado</option>
                        </select>
                        <button type="submit" class="btn-submit">Actualizar admin</button>
                    </form>
                </div>

                <script>
                    function confirmarActualizacion() {
                        return confirm("¿Estás seguro de que deseas actualizar los datos de este Empleado?");
                    }
                </script>
            <?php
            } else {
                echo "<p>No se encontró el admin.</p>";
            }
            ?>
        </body>

        </html>
<?php
    } else {
        echo "<p>No se encontró el admin.</p>";
    }
}
?>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->