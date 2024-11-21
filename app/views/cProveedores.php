<?php
session_start();
if (!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] !== 'admin') {
    header("Location: inicioSesion.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../controllers/proveedorController.php';
    $proveedorController = new ProveedorController();

    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $contacto = $_POST['contacto'];
    $telefono = $_POST['numeroT'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    // Intentar crear proveedor
    $mensajeError = $proveedorController->crearProveedor($nombre, $contacto, $telefono, $email, $direccion);
    if ($mensajeError !== true) {
        echo "<script>alert('.');</script>";
    } else {
        echo "<script>alert('Proveedor creado con éxito.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Proveedor - Genfarmex</title>
    <link rel="stylesheet" href="../static/css/create.css">
</head>

<body>
    <?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->
    
    <div class="container">
        <div class="logo">
            <img src="../static/img/letrasAzules.png" alt="Genfarmex" class="logo-img">
        </div>
        
        <div class="login-box">
            <h2>Crear proveedor</h2>
            <form action="../templates/crearProveedor.php" method="POST">
                <input type="text" name="nombre" placeholder="Nombre del proveedor" required>
                <input type="text" name="contacto" placeholder="Contacto del proveedor" required>
                <input type="tel" name="numeroT" placeholder="Número de teléfono" required pattern="[0-9]{10,15}" title="Ingrese un número de teléfono válido (10 a 15 dígitos)">
                <input type="email" name="email" placeholder="Correo electrónico del proveedor" required>
                <input type="text" name="direccion" placeholder="Dirección del proveedor" required>
                <button type="submit">Registrar</button>
            </form>
            <button class="back-button" onclick="history.back()">Regresar</button>
        </div>
    </div>
    
    <script defer src="../static/js/inicio.js"></script>
</body>

</html>
<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
