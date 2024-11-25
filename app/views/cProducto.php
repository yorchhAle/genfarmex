<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->
<<<<<<< HEAD

=======
>>>>>>> 4034973f32a9fa5bd37da43a6f0b996761c6ac3a
<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario no está logueado o si no tiene permisos de administrador
if (!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] !== 'admin') {
    // Si no es administrador, redirigir a la página de inicio de sesión
    header("Location: inicioSesion.html");
    exit; // Detener la ejecución del código si no es un admin
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto - Genfarmex</title>
<<<<<<< HEAD
    <link rel="stylesheet" href="../static/css/create.css"> <!-- Estilo CSS para la página -->
=======
    <link rel="stylesheet" href="../static/css/create.css">
>>>>>>> 4034973f32a9fa5bd37da43a6f0b996761c6ac3a

</head>

<body>
<<<<<<< HEAD
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú de navegación -->

=======
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->
>>>>>>> 4034973f32a9fa5bd37da43a6f0b996761c6ac3a
    <div class="container">
        <div class="logo">
            <img src="../static/img/letrasAzules.png" alt="Genfarmex" class="logo-img"> <!-- Mostrar el logo -->
        </div>
        <div class="login-box"> <!-- Caja de formulario para crear un producto -->
            <h2>Crear Producto</h2>
<<<<<<< HEAD
            <form action="../templates/crearProducto.php" method="POST"> <!-- Formulario que envía los datos a crearProducto.php -->
                <!-- Campo para la clave del producto -->
                <input type="text" name="clave" id="clave" placeholder="Clave del Producto" required>

                <!-- Campo para la descripción del producto -->
                <input type="text" name="desc" id="desc" placeholder="Descripción" required>

                <!-- Campo para las existencias del producto -->
                <input type="number" name="exis" id="exis" placeholder="Existencia" min="0" required>
                <!-- Mensaje de alerta para existencias negativas -->
                <p class="alert alert-danger" name="aviExis" id="aviExis" style="display: none">
                    No se puede ingresar un valor negativo de existencias
                </p>

                <!-- Campo para el precio del producto -->
                <input type="number" name="pre" id="pre" placeholder="Precio" min="0" required>
                <!-- Mensaje de alerta para precio negativo -->
                <p class="alert alert-danger" name="aviPre" id="aviPre" style="display: none">
                    No se puede ingresar un valor negativo en precio
                </p>

                <!-- Botón de envío con validación previa -->
                <button type="submit" onclick="return validateCProd();">Crear Producto</button>
            </form>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->

    <!-- Incluir el archivo JS para la validación del formulario -->
    <script defer src="../../static/js/valProduct.js"></script>
</body>
</html>
=======
            <form action="../templates/crearProducto.php" method="POST">
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
>>>>>>> 4034973f32a9fa5bd37da43a6f0b996761c6ac3a
