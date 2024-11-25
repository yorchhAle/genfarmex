<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->

<?php
require_once '../controllers/controladorDescuentos.php'; // Incluir el controlador de descuentos

// Verificar si la solicitud es un POST (cuando se envía el formulario)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario
    $idDescuento = $_POST['idDecuentos']; // ID del descuento a actualizar
    $nombre = $_POST['nombre']; // Nombre del descuento
    $porcentaje = $_POST['porcentaje']; // Porcentaje del descuento
    $fechaCreacion = $_POST['fechaCreacion']; // Fecha de creación del descuento

    // Crear una instancia del controlador de descuentos
    $descuentoController = new DescuentoController();

    // Intentar actualizar el descuento
    if ($descuentoController->actualizarDescuento($idDescuento, $nombre, $porcentaje, $fechaCreacion)) {
        // Si la actualización es exitosa, mostrar un mensaje de éxito y redirigir
        echo "<script>alert('Descuento actualizado exitosamente.'); window.location.href='listarDescuentos.php';</script>";
    } else {
        // Si hay un error, mostrar un mensaje de error y redirigir
        echo "<script>alert('Error al actualizar el descuento.'); window.location.href='eliminarActDes.php';</script>";
    }
} else {
    // Si la solicitud no es POST (es GET), obtener el ID del descuento desde la URL
    $idDescuento = $_GET['id'];

    // Crear una instancia del controlador de descuentos
    $descuentoController = new DescuentoController();

    // Obtener todos los descuentos
    $descuentos = $descuentoController->obtenerDescuentos();

    // Buscar el descuento actual mediante el ID
    $descuentoActual = array_filter($descuentos, fn($d) => $d['idDecuentos'] == $idDescuento);

    // Si el descuento se encuentra
    if ($descuentoActual) {
        // Obtener el primer resultado de la búsqueda
        $descuentoActual = reset($descuentoActual);
?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8"> <!-- Definir el juego de caracteres -->
            <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ajustar el diseño para dispositivos móviles -->
            <title>Actualizar Descuento</title>
            <link rel="stylesheet" href="../static/css/update.css"> <!-- Enlazar el archivo CSS para actualizar -->
        </head>
        <body>
            <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->

            <!-- Título de la página -->
            <h2 align="center">Actualizar Descuento</h2>

            <div class="form-container"> <!-- Contenedor del formulario -->
                <!-- Formulario para actualizar el descuento -->
                <form action="actualizarDescuento.php" method="POST" onsubmit="return confirmarActualizacion();">
                    <!-- Campo oculto para el ID del descuento -->
                    <input type="hidden" name="idDecuentos" value="<?php echo htmlspecialchars($descuentoActual['idDecuentos']); ?>">

                    <!-- Campo de texto para el nombre del descuento -->
                    <label for="nombre">Nombre del Descuento:</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($descuentoActual['nombre']); ?>" required>

                    <!-- Campo numérico para el porcentaje del descuento -->
                    <label for="porcentaje">Porcentaje:</label>
                    <input type="number" step="0.01" name="porcentaje" id="porcentaje" value="<?php echo htmlspecialchars($descuentoActual['porcentaje']); ?>" required>

                    <!-- Campo de fecha para la fecha de creación -->
                    <label for="fechaCreacion">Fecha de Creación:</label>
                    <input type="date" name="fechaCreacion" id="fechaCreacion" value="<?php echo htmlspecialchars($descuentoActual['FechaCreacion']); ?>" required>

                    <!-- Botón para enviar el formulario -->
                    <button type="submit" class="btn-submit">Actualizar Descuento</button>
                </form>
            </div>

            <script>
                // Confirmación antes de enviar el formulario
                function confirmarActualizacion() {
                    return confirm("¿Estás seguro de que deseas actualizar este descuento?");
                }
            </script>
        </body>
        </html>
<?php
    } else {
        // Si no se encuentra el descuento, mostrar un mensaje
        echo "<p>No se encontró el descuento.</p>";
    }
}
?>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
