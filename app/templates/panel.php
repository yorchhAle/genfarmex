<?php 
session_start();
if (!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] !== 'admin') {
    header("Location: inicioSesion.html");
    exit;
}
include '../includes/header.php'; // Incluir el encabezado
?> 

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../static/css/menuOpciones.css">
</head>

<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->

    <!-- Mensaje de bienvenida al principio de la página -->
    <div class="mensaje-bienvenida">
        <?php
        if (isset($_SESSION['usuario']) && isset($_SESSION['tipoUsuario'])) {
            echo "<h2>Bienvenido, " . htmlspecialchars($_SESSION['usuario']) . ". Ingreso como un " . htmlspecialchars($_SESSION['tipoUsuario']) . ".</h2>";
        }
        ?>
    </div>

    <!-- Contenido de la página -->
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
            <a href="reportesPanel.php">Empezar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/descuentos.png" alt="Imagen Admin">
                <h1>Generar consultas</h1>
            </div>
            <a href="consultasPanel.php">Empezar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/producto.png" alt="Imagen Blog 4">
                <h1>Generar respaldo</h1>
            </div>
            <a href="../../respaldos/index.php">Empezar</a>
        </article>
    </div>
</body>

</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
