<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->
<?php 
session_start();
if (!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] !== 'admin') {
    header("Location: inicioSesion.html");
    exit;
}
?> 
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Proveedor - Genfarmex</title>
    <link rel="stylesheet" href="../static/css/create.css">
    <script defer src="../static/js/validacioPro.js"></script>
</head>

<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->
    

    <div class="container">
        <div class="logo">
            <img src="../static/img/letrasAzules.png" alt="Genfarmex" class="logo-img">
        </div>
        <div class="login-box">
            <h2>Crear Proveedor</h2>
            <form action="../templates/crearProveedor.php" method="POST" onsubmit="return validateForm()">
                <input type="text" name="nombre" placeholder="Nombre del proveedor" required>
                <input type="text" name="contacto" placeholder="Contacto" required>
                <input type="tel" name="numeroT" placeholder="Número de teléfono" required pattern="[0-9]{10,15}" title="Ingrese un número de teléfono válido (10 a 15 dígitos)">
                <input type="email" name="email" placeholder="Email del proveedor" required>
                <input type="text" name="direccion" placeholder="Dirección del proveedor" required>
                <button type="submit">Crear Proveedor</button>
                <button class="back-button" onclick="history.back()">Regresar</button>
            </form>
        </div>
    </div>
</body>

</html>
<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->

