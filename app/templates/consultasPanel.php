<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../static/css/menuOpciones.css">
</head>

<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->

    <div class="contenedor cuatro-columnas">
        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/cliente.png" alt="Imagen Admin">
                <h1>Consulta de domicilios</h1>
            </div>
            <a href="../views/consultaDomicilios.php">Generar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/empleados.png" alt="Imagen Blog 4">
                <h1>Consulta de clientes</h1>
            </div>
            <a href="../views/consultaClientes.php">Generar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/producto.png" alt="Imagen Blog 4">
                <h1>consulta de almacen</h1>
            </div>
            <a href="listarProducto.php">Generar</a>
        </article>
    </div>

</body>

</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
