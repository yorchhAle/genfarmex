<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->

<?php
require_once '../controllers/controladorDescuentos.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $idDescuento = $_POST['idDecuentos'];
    $nombre = $_POST['nombre'];
    $porcentaje = $_POST['porcentaje'];
    $fechaCreacion = $_POST['fechaCreacion'];

    $descuentoController = new DescuentoController();
    if ($descuentoController->actualizarDescuento($idDescuento, $nombre, $porcentaje, $fechaCreacion)) {
        echo "<script>alert('Descuento actualizado exitosamente.'); window.location.href='listarDescuentos.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el descuento.'); window.location.href='eliminarActDes.php';</script>";
    }
} else {
    $idDescuento = $_GET['id'];
    $descuentoController = new DescuentoController();
    $descuentos = $descuentoController->obtenerDescuentos();
    $descuentoActual = array_filter($descuentos, fn($d) => $d['idDecuentos'] == $idDescuento);

    if ($descuentoActual) {
        $descuentoActual = reset($descuentoActual);
?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Actualizar Descuento</title>
            <link rel="stylesheet" href="../static/css/update.css">
        </head>
        <body>
            <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->
            <h2 align="center">Actualizar Descuento</h2>
            <div class="form-container">
                <form action="actualizarDescuento.php" method="POST" onsubmit="return confirmarActualizacion();">
                    <input type="hidden" name="idDecuentos" value="<?php echo htmlspecialchars($descuentoActual['idDecuentos']); ?>">

                    <label for="nombre">Nombre del Descuento:</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($descuentoActual['nombre']); ?>" required>

                    <label for="porcentaje">Porcentaje:</label>
                    <input type="number" step="0.01" name="porcentaje" id="porcentaje" value="<?php echo htmlspecialchars($descuentoActual['porcentaje']); ?>" required>

                    <label for="fechaCreacion">Fecha de Creación:</label>
                    <input type="date" name="fechaCreacion" id="fechaCreacion" value="<?php echo htmlspecialchars($descuentoActual['FechaCreacion']); ?>" required>

                    <button type="submit" class="btn-submit">Actualizar Descuento</button>
                </form>
            </div>

            <script>
                function confirmarActualizacion() {
                    return confirm("¿Estás seguro de que deseas actualizar este descuento?");
                }
            </script>
        </body>
        </html>
<?php
    } else {
        echo "<p>No se encontró el descuento.</p>";
    }
}
?>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
