<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto - Genfarmex</title>
    <link rel="stylesheet" href="../static/css/create.css">
    
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="../static/img/letrasAzules.png" alt="Genfarmex" class="logo-img">
        </div>
        <div class="login-box">
            <h2>Crear Producto</h2>
            <form action="../templates/Producto/crearProducto.php" method="POST">
                <input type="text" name="clave" placeholder="Clave del Producto" required>
                <input type="text" name="desc" placeholder="Descripción" required>
                <input type="text" name="exis" placeholder="Existencia" onkeypress="if((event.keyCode < 48) || (event.keyCode >57)){event.returnValue=false;}" required>
                <input type="text" name="pre" placeholder="Precio" onkeypress="if((event.keyCode < 48) || (event.keyCode >57)){event.returnValue=false;}" required>
                <button type="submit">Crear Producto</button>
            </form>
        </div>
        
    </div>
    <?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->

    <script defer src="../../static/js/valProduct.js"></script>
</body>
</html>
