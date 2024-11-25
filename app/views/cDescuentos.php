<<<<<<< HEAD
<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->
<?php 
=======
<?php
>>>>>>> b8abc8242745b729ee0e02b3a5e32c34c67609f0
session_start();
if (!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] !== 'admin') {
    header("Location: inicioSesion.html");
    exit;
}
<<<<<<< HEAD
?> 
=======
?>
<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->



>>>>>>> b8abc8242745b729ee0e02b3a5e32c34c67609f0
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Descuento - Genfarmex</title>
    <link rel="stylesheet" href="../static/css/create.css">
</head>

<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->
<<<<<<< HEAD
    
=======
>>>>>>> b8abc8242745b729ee0e02b3a5e32c34c67609f0
    <div class="container">
        <div class="logo">
            <img src="../static/img/letrasAzules.png" alt="Genfarmex" class="logo-img">
        </div>

        <div class="login-box">
            <h2>Crear descuento</h2>
            <form action="../templates/crearDescuento.php" method="POST">
                <input type="text" name="nombre" placeholder="Nombre del descuento" required>
                <p style="color: gray; font-size: 0.9em;">* El nombre debe ser único</p>
                <input type="number" step="0.01" name="porcentaje" placeholder="Porcentaje de descuento a agregar" required>
                <input type="date" name="fechaCreacion" placeholder="Fecha de creación" required>
                <button type="submit">Registrar</button>
            </form>
            <button class="back-button" onclick="history.back()">Regresar</button>
        </div>
    </div>
    <script defer src="../static/js/inicio.js"></script>
    <br><br>
</body>

</html>
<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
