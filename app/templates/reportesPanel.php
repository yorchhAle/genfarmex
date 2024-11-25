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
    <link rel="stylesheet" href="../static/css/menuOpciones.css">
</head>

<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->

    <div class="contenedor cuatro-columnas">
        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/cliente.png" alt="Imagen Admin">
                <h1>Reporte de clientes</h1>
            </div>
            <a href="reporteClientes.php">Generar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/empleados.png" alt="Imagen Blog 4">
                <h1>Reporte de empleados</h1>
            </div>
            <a href="reporteEmpleados.php">Generar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/producto.png" alt="Imagen Blog 4">
                <h1>Reporte de productos</h1>
            </div>
            <a href="reporteProductos.php">Generar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/proveedor.png" alt="Imagen Blog 4">
                <h1>Reporte de proveedores</h1>
            </div>
            <a href="reporteProveedores.php">Generar</a>
        </article>

        <article class="entrada-blog">
            <div class="blog-contenido">
                <img src="../static/img/descuentos.png" alt="Imagen Admin">
                <h1>Reporte de ventas</h1>
            </div>
            <a href="reporteVentas.php">Generar</a>
        </article>
    </div>

</body>

</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
