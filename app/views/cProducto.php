<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->
<<<<<<< HEAD
<?php
session_start();
if (!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] !== 'admin') {
    header("Location: inicioSesion.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

=======
<!DOCTYPE html>
<html lang="es">
>>>>>>> 36167dfa535c78088b875c03b15f29834aeebeee
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto - Genfarmex</title>
    <link rel="stylesheet" href="../static/css/create.css">
<<<<<<< HEAD

</head>

<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->
=======
    
</head>
<body>
>>>>>>> 36167dfa535c78088b875c03b15f29834aeebeee
    <div class="container">
        <div class="logo">
            <img src="../static/img/letrasAzules.png" alt="Genfarmex" class="logo-img">
        </div>
        <div class="login-box">
            <h2>Crear Producto</h2>
            <form action="../templates/crearProducto.php" method="POST">
<<<<<<< HEAD
                <input type="text" name="clave" placeholder="Clave del Producto" required>
                <input type="text" name="desc" placeholder="Descripción" required>
                <input type="text" name="exis" placeholder="Existencia"
                    onkeypress="if((event.keyCode < 48) || (event.keyCode >57)){event.returnValue=false;}" required>
                <input type="text" name="pre" placeholder="Precio"
                    onkeypress="if((event.keyCode < 48) || (event.keyCode >57)){event.returnValue=false;}" required>
                <button type="submit">Crear Producto</button>
                <button class="back-button" onclick="history.back()">Regresar</button>
            </form>
        </div>

    </div>
    <script defer src="../../static/js/valProduct.js"></script>
</body>

</html>
<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
=======
                <input type="text" name="clave" id="clave" placeholder="Clave del Producto" required>
                <input type="text" name="desc" id="desc" placeholder="Descripción" required>
                <input type="number" name="exis" id="exis" placeholder="Existencia" min="0" required>
                <p class="alert alert-danger" name="aviExis" id="aviExis" style="display: none">
                    No se puede ingresar un valor negativo de existencias
                </p>
                <input type="number" name="pre" id="pre" placeholder="Precio" min="0" required>
                <p class="alert alert-danger" name="aviPre" id="aviPre" style="display: none">
                    No se puede ingresar un valor negativo en precio
                </p>
                <button type="submit" onclick="return validateCProd();">Crear Producto</button>
            </form>
        </div>
        
    </div>
    <?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->

    <script defer src="../../static/js/valProduct.js"></script>
</body>
</html>
>>>>>>> 36167dfa535c78088b875c03b15f29834aeebeee
