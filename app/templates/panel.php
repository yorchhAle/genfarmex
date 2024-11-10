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
                <img src="../static/img/admin.png" alt="Imagen Admin">
                <h1>Gestiones</h1>
            </div>
            <a href="gestionesPanel.php">Empezar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/cliente.png" alt="Imagen Blog 2">
                <h1>Generar reportes</h1>
            </div>
            <a href="#">Empezar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/descuentos.png" alt="Imagen Admin">
                <h1>Generar consultas</h1>
            </div>
            <a href="#">Empezar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/producto.png" alt="Imagen Blog 4">
                <h1>Generar respaldo</h1>
            </div>
            <a href="#">Empezar</a>
        </article>
    </div>

</body>

</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
