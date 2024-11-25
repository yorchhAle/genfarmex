<?php
// Iniciar la sesión para gestionar el acceso del usuario
session_start();

// Verificar si el usuario tiene el tipo 'admin' en la sesión
// Si no es un administrador, redirigir al inicio de sesión
if (!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] !== 'admin') {
    header("Location: inicioSesion.html");
    exit; // Terminar la ejecución si no es un administrador
}

// Verificar si la solicitud HTTP es de tipo POST (cuando se envían los datos del formulario)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Incluir el controlador de proveedores
    require_once '../controllers/proveedorController.php';

    // Crear una instancia del controlador de proveedores
    $proveedorController = new ProveedorController();

    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];         // Nombre del proveedor
    $contacto = $_POST['contacto'];     // Contacto del proveedor
    $telefono = $_POST['numeroT'];      // Número de teléfono del proveedor
    $email = $_POST['email'];           // Correo electrónico del proveedor
    $direccion = $_POST['direccion'];   // Dirección del proveedor

    // Intentar crear un nuevo proveedor usando el controlador
    $mensajeError = $proveedorController->crearProveedor($nombre, $contacto, $telefono, $email, $direccion);

    // Verificar si la creación fue exitosa o si hubo un error
    if ($mensajeError !== true) {
        // Si hay un error al crear el proveedor, mostrar un mensaje de error
        echo "<script>alert('.');</script>";  // Aquí se puede mejorar el mensaje de error
    } else {
        // Si se crea el proveedor exitosamente, mostrar un mensaje de éxito
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
    <!-- Enlazar al archivo de estilos CSS para la página -->
    <link rel="stylesheet" href="../static/css/create.css">
</head>

<body>
    <?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->
    
    <div class="container">
        <div class="logo">
            <!-- Imagen del logo -->
            <img src="../static/img/letrasAzules.png" alt="Genfarmex" class="logo-img">
        </div>
        
        <div class="login-box">
            <h2>Crear proveedor</h2>
            <!-- Formulario para crear un proveedor -->
            <form action="../templates/crearProveedor.php" method="POST">
                <!-- Campos del formulario para ingresar los datos del proveedor -->
                <input type="text" name="nombre" placeholder="Nombre del proveedor" required>
                <input type="text" name="contacto" placeholder="Contacto del proveedor" required>
                <input type="tel" name="numeroT" placeholder="Número de teléfono" required pattern="[0-9]{10,15}" title="Ingrese un número de teléfono válido (10 a 15 dígitos)">
                <input type="email" name="email" placeholder="Correo electrónico del proveedor" required>
                <input type="text" name="direccion" placeholder="Dirección del proveedor" required>
                <!-- Botón para enviar el formulario -->
                <button type="submit">Registrar</button>
            </form>
            <!-- Botón para regresar a la página anterior -->
            <button class="back-button" onclick="history.back()">Regresar</button>
        </div>
    </div>
    
    <!-- Incluir un script externo, si es necesario -->
    <script defer src="../static/js/inicio.js"></script>
</body>

</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
