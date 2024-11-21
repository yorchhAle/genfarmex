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
<<<<<<< HEAD
    <link rel="stylesheet" href="../static/css/catalogo.css"> <!-- Nuevo CSS minimalista -->
    <title>Catálogo de Productos</title>
=======
    <link rel="stylesheet" href="../static/css/inicio2.css">
    
    <title>Catalogo - Genfarmex</title>
>>>>>>> 36167dfa535c78088b875c03b15f29834aeebeee
</head>
<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->

<<<<<<< HEAD
    <div class="container">
        <h1 class="title">Catálogo de Productos</h1>

        <div class="search-bar">
            <form method="get" action="">
                <input class="input-search" type="text" name="filtro" placeholder="Buscar productos..." value="<?php echo htmlspecialchars($filtro); ?>">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </form>
            <form method="get" action="">
                <button class="btn btn-secondary" type="submit">Mostrar todos</button>
            </form>
            <a class="btn btn-back" href="CRUDProducto.php">Regresar</a>
        </div>
=======
    <div class="catalogo">
    <?php 
    foreach ($productos as $producto) {
    ?>
        <div class="card">
            <p><bold>Clave:</bold> <?php echo htmlspecialchars($producto['clave']); ?></p>
            <p><bold>Descripción:</bold> <?php echo htmlspecialchars($producto['descripcion']); ?></p>
            <p><bold>Existencias:</bold> <?php echo htmlspecialchars($producto['existencias']); ?></p>
            <p><bold>Precio:</bold> <?php echo htmlspecialchars(number_format($producto['precioUnitario'], 2)); ?></p>
            <div class="wrapper" data-existencias="<?php echo htmlspecialchars($producto['existencias']); ?>">
                <div class="sub">-</div>
                <div class="value">0</div>
                <div class="add">+</div>
            </div>
            <script>
                (function() {
                    const card = document.currentScript.closest(".card");
                    const sub = card.querySelector(".sub");
                    const value = card.querySelector(".value");
                    const add = card.querySelector(".add");
                    const maxExistencias = parseInt(card.querySelector(".wrapper").getAttribute("data-existencias"), 10);

                    let totalValue = 0;
                    value.innerHTML = totalValue;

                    add.onclick = function() {
                        if (totalValue < maxExistencias) {
                            totalValue++;
                            value.innerHTML = totalValue;
                        } else {
                            alert("No puedes agregar más de las existencias disponibles.");
                        }
                    };

                    sub.onclick = function() {
                        if (totalValue > 0) {
                            totalValue--;
                            value.innerHTML = totalValue;
                        }
                    };
                })();
            </script>
            <a href="actualizarProducto.php?id=<?php echo $producto['id']; ?>">Actualizar</a>
            <a href="eliminarProducto.php?id=<?php echo $producto['id']; ?>">Eliminar</a>
        </div>
    <?php
    } 
    ?>

</div>
>>>>>>> 36167dfa535c78088b875c03b15f29834aeebeee

        <div class="catalogo">
            <?php foreach ($productos as $producto): ?>
                <div class="card">
                    <h2 class="product-name"><?php echo htmlspecialchars($producto['descripcion']); ?></h2>
                    <p><span class="label">Clave:</span> <?php echo htmlspecialchars($producto['clave']); ?></p>
                    <p><span class="label">Existencias:</span> <?php echo htmlspecialchars($producto['existencias']); ?></p>
                    <p><span class="label">Precio:</span> $<?php echo htmlspecialchars(number_format($producto['precioUnitario'], 2)); ?></p>
                    <div class="card-actions">
                        <a class="btn btn-update" href="actualizarProducto.php?id=<?php echo $producto['id']; ?>">Actualizar</a>
                        <a class="btn btn-delete" href="eliminarProducto.php?id=<?php echo $producto['id']; ?>">Eliminar</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="pagination">
            <?php if ($pagina > 1): ?>
                <a class="btn-pagination" href="?filtro=<?php echo urlencode($filtro); ?>&pagina=<?php echo $pagina - 1; ?>">Anterior</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <a class="btn-pagination <?php echo $i == $pagina ? 'active' : ''; ?>" href="?filtro=<?php echo urlencode($filtro); ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ($pagina < $totalPaginas): ?>
                <a class="btn-pagination" href="?filtro=<?php echo urlencode($filtro); ?>&pagina=<?php echo $pagina + 1; ?>">Siguiente</a>
            <?php endif; ?>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
</body>
</html>
