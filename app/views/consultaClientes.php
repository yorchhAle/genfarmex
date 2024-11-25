<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado común del proyecto -->
<?php include '../includes/menu.php'; ?> <!-- Incluir el menú común del proyecto -->

<?php
// Incluir el controlador de usuarios
require_once '../controllers/controladorUs.php';

// Crear una instancia del controlador
$controller = new UsController();

// Determinar el estatus a consultar ('activo' o 'baja') a partir de la URL, por defecto 'activo'
$estatus = isset($_GET['estatus']) ? $_GET['estatus'] : 'activo';

// Obtener la lista de clientes según el estatus
$clientes = $controller->listarClientesPorEstatus($estatus);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Clientes</title>
    <!-- Enlace a Bootstrap para estilos responsivos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace al archivo CSS personalizado -->
    <link rel="stylesheet" href="../static/css/consultas.css">
</head>

<body>
    <!-- Contenedor principal -->
    <div class="container my-5">
        <!-- Título de la página, mostrando el estatus actual -->
        <h1 class="text-center mb-4">Consulta de Clientes - <?php echo ucfirst($estatus); ?></h1>

        <!-- Formulario para seleccionar el estatus de clientes -->
        <form method="GET" class="mb-4 text-center">
            <label for="estatus" class="form-label fs-5">Selecciona el estatus:</label>
            <!-- Menú desplegable para elegir entre 'activo' y 'baja' -->
            <select name="estatus" id="estatus" class="form-select w-50 d-inline-block">
                <option value="activo" <?php echo $estatus === 'activo' ? 'selected' : ''; ?>>Activos</option>
                <option value="baja" <?php echo $estatus === 'baja' ? 'selected' : ''; ?>>Bajas</option>
            </select>
            <!-- Botón para enviar el formulario -->
            <button type="submit" class="btn btn-primary">Consultar</button>
        </form>

        <!-- Mostrar tarjetas con información de los clientes -->
        <div class="row g-4">
            <?php foreach ($clientes as $cliente): ?> <!-- Recorrer y mostrar cada cliente -->
                <div class="col-md-3">
                    <div class="card shadow-sm h-100"> <!-- Tarjeta con sombra -->
                        <div class="card-body">
                            <!-- Nombre y apellido del cliente -->
                            <h5 class="card-title text-primary"><?php echo htmlspecialchars($cliente['nombre'] . " " . $cliente['apellido']); ?></h5>
                            <!-- Información adicional del cliente -->
                            <p class="card-text"><strong>Correo:</strong> <?php echo htmlspecialchars($cliente['correo']); ?></p>
                            <p class="card-text"><strong>Teléfono:</strong> <?php echo htmlspecialchars($cliente['telefono']); ?></p>
                            <p class="card-text"><strong>Crédito:</strong> <?php echo htmlspecialchars($cliente['creditoC']); ?></p>
                            <p class="card-text"><strong>Estatus:</strong> <?php echo htmlspecialchars($cliente['estatusC']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS para funcionalidades adicionales -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página común del proyecto -->
