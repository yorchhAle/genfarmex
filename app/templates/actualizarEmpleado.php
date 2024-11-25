<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->

<?php
require_once '../controllers/controladorUs.php'; // Incluir el controlador de usuario
$clienteController = new UsController(); // Crear una instancia del controlador de usuario

// Verificar si la solicitud es un POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados desde el formulario
    $idUsuario = $_POST['idUsuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $tipoUsuario = $_POST['tipoUsuario'];

    // Llamar al método para actualizar el usuario en la base de datos
    $resultado = $clienteController->actualizarUsuario($idUsuario, $nombre, $apellido, $usuario, $pass, $correo, $telefono, $direccion, $tipoUsuario, [
        'fechaAlta' => $fechaAlta,
    ]);

    // Mostrar un mensaje dependiendo si la actualización fue exitosa o falló
    if ($resultado) {
        echo "<script>alert('Cliente actualizado exitosamente.'); window.location.href='listarAdmins.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el cliente.'); window.location.href='listarAdmins.php';</script>";
    }
} else {
    // Si no es un POST, obtener el ID del admin desde la URL
    $idAdmin = $_GET['id'];
    $AdminActual = $clienteController->obtenerUsuarios($idAdmin); // Obtener los datos del admin

    // Verificar si se encontró el admin
    if ($AdminActual) {
?>
        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Actualizar Cliente</title>
            <link rel="stylesheet" href="../static/css/update.css"> <!-- Incluir hoja de estilos -->
        </head>

        <body>
            <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->

            <?php
            $idAdmin = $_GET['id']; // Obtener el ID del admin
            if ($AdminActual) {
            ?>
                <h2 align="center">Actualizar Cliente</h2>
                <div class="form-container">
                    <form action="actualizarAdmis.php" method="POST" onsubmit="return confirmarActualizacion();">

                        <!-- Campo oculto para el idUsuario -->
                        <input type="hidden" name="idUsuario" value="<?php echo htmlspecialchars($idAdmin); ?>">

                        <!-- Campos del formulario para actualizar los datos del admin -->
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
                    // Función para confirmar la actualización de los datos del admin
                    function confirmarActualizacion() {
                        return confirm("¿Estás seguro de que deseas actualizar los datos de este Empleado?");
                    }
                </script>
            <?php
            } else {
                echo "<p>No se encontró el admin.</p>"; // Si no se encuentra el admin
            }
            ?>
        </body>

        </html>
<?php
    } else {
        echo "<p>No se encontró el admin.</p>"; // Si no se encuentra el admin
    }
}
?>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
