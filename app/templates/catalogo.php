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

<?php 
session_start();
if (!isset($_SESSION['tipoUsuario']) || ($_SESSION['tipoUsuario'] !== 'cliente' && $_SESSION['tipoUsuario'] !== 'admin')) {
    header("Location: ../views/inicioSesion.html");
    exit;
}
?> 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../static/css/inicio2.css">
    
    <title>Catalogo - Genfarmex</title>
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
            <div class="wrapper" data-existencias="<?php echo htmlspecialchars($producto['existencias']); ?>">
                <div class="sub">-</div>
                <div class="value">0</div>
                <div class="add">+</div>
            </div>
            <form method="POST" action="carrito.php">
                <input type="hidden" name="cantidad" class="cantidad" value="0">
                <a class="anadir" href="#" data-id="<?php echo $producto['id']; ?>" onclick="actualizarHref(this, event)">Añadir</a>
            </form>
            <script>
                function actualizarHref(anchor, event) {
                    const card = anchor.closest(".card");
                    const value = parseInt(card.querySelector(".value").innerHTML, 10); // Obtén el valor actual como número
                    const id = anchor.getAttribute("data-id"); // Obtén el id del atributo data-id

                    if (value > 0) {
                        // Si totalValue es mayor a 0, actualiza el href con los valores dinámicos
                        anchor.href = `anadirCarrito.php?id=${id}&cantidad=${value}`;
                    } else {
                        // Si no, evita el comportamiento predeterminado del enlace
                        event.preventDefault();
                        alert("La cantidad debe ser mayor a 0 para añadir al carrito.");
                    }
                }

                (function() {
                    const card = document.currentScript.closest(".card");
                    const sub = card.querySelector(".sub");
                    const value = card.querySelector(".value");
                    const add = card.querySelector(".add");
                    const cantidadInput = card.querySelector(".cantidad");
                    const maxExistencias = parseInt(card.querySelector(".wrapper").getAttribute("data-existencias"), 10);

                    let totalValue = 0;
                    value.innerHTML = totalValue;

                    add.onclick = function() {
                        if (totalValue < maxExistencias) {
                            totalValue++;
                            value.innerHTML = totalValue;
                            cantidadInput.value = totalValue;
                        } else {
                            alert("No puedes agregar más de las existencias disponibles.");
                        }
                    };

                    sub.onclick = function() {
                        if (totalValue > 0) {
                            totalValue--;
                            value.innerHTML = totalValue;
                            cantidadInput.value = totalValue;
                        }
                    };
                })();
            </script>


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
