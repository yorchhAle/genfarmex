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
    <title>Document</title>
    <link rel="stylesheet" href="../static/css/menuOpciones2.css">
</head>

<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->

    <div class="contenedor cuatro-columnas">
        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/cliente.png" alt="Imagen Admin">
                <h1>Gestión de clientes</h1>
            </div>
            <a href="CRUDClientes.php">Empezar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/admin.png" alt="Imagen Blog 2">
                <h1>Gestión de administradores</h1>
            </div>
            <a href="CRUDAdmin.php">Empezar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/descuentos.png" alt="Imagen Admin">
                <h1>Gestión de descuentos</h1>
            </div>
            <a href="CRUDDescuentos.php">Empezar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/empleados.png" alt="Imagen Blog 4">
                <h1>Gestión de empleados</h1>
            </div>
            <a href="CRUDClientes.php">Empezar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/producto.png" alt="Imagen Blog 4">
                <h1>Gestión de productos</h1>
            </div>
            <a href="#">Empezar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/proveedor.png" alt="Imagen Blog 4">
                <h1>Gestión de proveedores</h1>
            </div>
            <a href="CRUDProveedores.php">Empezar</a>
        </article>
    </div>

</body>

</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
