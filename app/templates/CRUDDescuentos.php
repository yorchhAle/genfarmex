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
    <h1 align="center">CRUD Descuentos</h1>

    <div class="contenedor cuatro-columnas">
        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/crear.png" alt="Imagen Admin">
                <h1>Crear</h1>
            </div>
            <a href="../views/cDescuentos.php">Empezar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/lectura.png" alt="Imagen Blog 2">
                <h1>Lectura</h1>
            </div>
            <a href="listarDescuentos.php">Empezar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/actualizar.png" alt="Imagen Admin">
                <h1>Actualizar</h1>
            </div>
            <a href="eliminarActDes.php">Empezar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/eliminar.png" alt="Imagen Blog 4">
                <h1>Eliminar</h1>
            </div>
            <a href="eliminarActDes.php">Empezar</a>
        </article>
    </div>
</body>

</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->