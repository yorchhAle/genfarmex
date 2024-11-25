<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->

<?php
require_once '../../config/db.php'; // Archivo de conexión a la base de datos
$conn = getConnection();
session_start();
// Validar sesión
if (!isset($_SESSION['tipoUsuario']) || ($_SESSION['tipoUsuario'] !== 'cliente' && $_SESSION['tipoUsuario'] !== 'admin')) {
    header("Location: ../views/inicioSesion.html");
    exit;
}

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
    $creditoC = $_POST['creditoC'];
    $estatusC = $_POST['estatusC'];
    $tipoUsuario = $_POST['tipoUsuario'];

    $resultado = $clienteController->actualizarUsuario($idUsuario, $nombre, $apellido, $usuario, $pass, $correo, $telefono, $direccion, $tipoUsuario, [
        'credito' => $creditoC,
        'estatus' => $estatusC
    ]);

    // Actualizar el cliente
    if ($resultado) {
        echo "<script>alert('Cliente actualizado exitosamente.'); window.location.href='listarClientes.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el cliente.'); window.location.href='listarClientes.php';</script>";
    }
} else {
    // Obtener ID del cliente desde GET
    $nomCliente = $_SESSION['usuario'];

    $query = "SELECT usuarios.idusuario 
              FROM usuarios 
              INNER JOIN clientes ON clientes.idusuario = usuarios.idusuario 
              WHERE usuarios.usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nomCliente);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $idCliente = $row['idusuario']; // Obtener el ID del cliente
    $stmt->close();

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
            <?php include '../includes/menuCliente.php'; ?> <!-- Incluir el menú -->
            <?php
            $clienteActual = $clienteController->obtenerClienteConUsuario($idCliente);

            if ($clienteActual) {
            ?>
                <h2 align="center">Actualizar Cliente</h2>
                <div class="form-container">
                    <form action="actualizarClientes.php" method="POST" onsubmit="return confirmarActualizacion();">
                        <!-- Campo oculto para el idUsuario -->
                        <input type="hidden" name="idUsuario" value="<?php echo htmlspecialchars($idCliente); ?>">

                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($clienteActual['nombre']); ?>" required>

                        <label for="apellido">Apellido:</label>
                        <input type="text" name="apellido" id="apellido" value="<?php echo htmlspecialchars($clienteActual['apellido']); ?>" required>

                        <label for="usuario">Usuario:</label>
                        <input type="text" name="usuario" id="usuario" value="<?php echo htmlspecialchars($clienteActual['usuario']); ?>" required>

                        <label for="pass">Contraseña:</label>
                        <input type="password" name="pass" id="pass" value="<?php echo htmlspecialchars($clienteActual['pass']); ?>" required>

                        <label for="correo">Correo:</label>
                        <input type="email" name="correo" id="correo" value="<?php echo htmlspecialchars($clienteActual['correo']); ?>" required>

                        <label for="telefono">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" value="<?php echo htmlspecialchars($clienteActual['telefono']); ?>" required>

                        <label for="direccion">Dirección:</label>
                        <input type="text" name="direccion" id="direccion" value="<?php echo htmlspecialchars($clienteActual['direccion']); ?>" required>

                        <label for="tipoUsuario">Tipo de Usuario:</label>
                        <select name="tipoUsuario" id="tipoUsuario" required>
                            <option value="cliente" <?php echo (isset($clienteActual['tipoUsuario']) && $clienteActual['tipoUsuario'] == 'cliente') ? 'selected' : ''; ?>>Cliente</option>
                        </select>

                        <label for="creditoC">Crédito:</label>
                        <input type="number" name="creditoC" id="creditoC" value="<?php echo htmlspecialchars($clienteActual['creditoC']); ?>" required readonly>

                        <label for="estatusC">Estatus:</label>
                        <input type="text" name="estatusC" id="estatusC" value="<?php echo htmlspecialchars($clienteActual['estatusC']); ?>" required readonly>

                        <button type="submit" class="btn-submit">Actualizar Cliente</button>
                    </form>
                </div>

                <script>
                    function confirmarActualizacion() {
                        return confirm("¿Estás seguro de que deseas actualizar este cliente?");
                    }
                </script>

            <?php
            } else {
                echo "<p>No se encontró el cliente.</p>";
            }
            ?>
        </body>

        </html>
<?php
    } else {
        echo "<p>No se encontró el cliente.</p>";
    }
}
?>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->