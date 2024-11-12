<?php
require_once '../controllers/controladorProducto.php';

$controller = new ProductoController();
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : "";
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

// Obtener productos para la página actual
$productos = $controller->mostrarProductos($filtro, $pagina);

// Calcular el número total de productos y páginas
$totalProductos = $controller->contarProductos($filtro);
$totalPaginas = ceil($totalProductos / 40);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../static/css/inicio2.css">
    
    <title>Catalogo</title>
</head>
<header> 
    <?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->
</header>
<body>
<?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->
    <hr>    
    <div class="barra-busq">
    <h1>Buscar Productos</h1>
    <form method="get" action="">
        <input class="filtro" type="text" name="filtro" placeholder="Buscar..."><br>
        <button type="submit">Buscar</button>
    </form>
    <form method="get" action="">
        <button type="submit">Mostrar todos</button><br><br>
    </form>
    </div>

    <div class="catalogo">
    <?php 
        foreach ($productos as $producto) {
    ?>
        <div class="card">
            <p><bold>Clave:</bold> <?php echo htmlspecialchars($producto['clave']); ?></p>
            <p><bold>Descripción:</bold> <?php echo htmlspecialchars($producto['descripcion']); ?></p>
            <p><bold>Existencias:</bold> <?php echo htmlspecialchars($producto['existencias']); ?></p>
            <p><bold>Precio:</bold> <?php echo htmlspecialchars(number_format($producto['precioUnitario'], 2)); ?></p>
            <a href="actualizarProducto.php?id=<?php echo $producto['id']; ?>">Actualizar</a>
            <a href="eliminarProducto.php?id=<?php echo $producto['id']; ?>">Eliminar</a>
        </div>
    <?php
        } 
    ?>
</div>



    <br>
    <!-- Paginación -->
    <div class="paginacion">
        <?php if ($pagina > 1): ?>
            <a href="?filtro=<?php echo urlencode($filtro); ?>&pagina=<?php echo $pagina - 1; ?>">Anterior</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <?php if ($i == $pagina): ?>
                <strong><?php echo $i; ?></strong>
            <?php else: ?>
                <a href="?filtro=<?php echo urlencode($filtro); ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($pagina < $totalPaginas): ?>
            <a href="?filtro=<?php echo urlencode($filtro); ?>&pagina=<?php echo $pagina + 1; ?>">Siguiente</a>
        <?php endif; ?>
    </div>
</body>
</html>
