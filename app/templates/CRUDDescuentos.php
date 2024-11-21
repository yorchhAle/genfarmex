<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../static/css/menuOpciones2.css">
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
    </div>
    <button class="back-button" onclick="history.back()">Regresar</button> <!-- Botón de regreso -->

</body>

</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->