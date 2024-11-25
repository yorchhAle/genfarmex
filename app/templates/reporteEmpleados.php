<?php 
// Iniciar sesión
session_start();

// Verificar si el usuario tiene permisos de administrador
if (!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] !== 'admin') {
    header("Location: inicioSesion.html"); // Redirigir a la página de inicio de sesión si no es administrador
    exit; // Detener la ejecución del script
}

// Incluir el encabezado común del proyecto
include '../includes/header.php';
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de empleados</title>
    <!-- Enlace a Bootstrap CSS para estilos responsivos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace a un archivo CSS personalizado -->
    <link rel="stylesheet" href="../static/css/reportes.css">
</head>
<body>
<?php include '../includes/menu.php'; ?> <!-- Incluir el menú común del proyecto -->

<!-- Contenedor principal -->
<div class="container">
    <!-- Formulario para generar reportes -->
    <div class="form-card mx-auto col-md-6">
        <h1 class="text-center mb-4">Generar reportes de empleados</h1>
        <p class="text-center">Genere reportes personalizados de empleados según su fecha de registro y el rol (puesto).</p>
        
        <!-- Formulario que permite generar reportes con parámetros -->
        <form action="../convertirpdf/reporteEmpleados2.php" method="POST">
            <!-- Campo para la fecha de inicio -->
            <div class="mb-3">
                <label for="fechaInicio" class="form-label">Fecha de Contratación (Inicio)</label>
                <input type="date" class="form-control" id="fechaInicio" name="fechaInicio">
            </div>

            <!-- Campo para la fecha de fin -->
            <div class="mb-3">
                <label for="fechaFin" class="form-label">Fecha de Contratación (Fin)</label>
                <input type="date" class="form-control" id="fechaFin" name="fechaFin">
            </div>

            <!-- Campo para filtrar por rol del empleado -->
            <div class="mb-3">
                <label for="rol" class="form-label">Rol del empleado</label>
                <input type="text" class="form-control" id="rol" name="rol" placeholder="Ej. Administrador">
            </div>

            <!-- Botones para enviar el formulario o regresar -->
            <div class="d-flex justify-content-between">
                <a href="reportesPanel.php" class="btn btn-secondary">Regresar</a>
                <button type="submit" name="generarConParametros" class="btn btn-primary">Generar con parámetros</button>
            </div>
        </form>
        <br>
        <!-- Botón para generar reportes sin parámetros -->
        <div class="d-flex justify-content-between">
            <button class="btn btn-primary me-2">
                <a href="../convertirpdf/reporteEmpleados1.php" style="color: white; text-decoration: none;">Generar sin parámetros</a>
            </button>
        </div>
    </div>
</div>
<br>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página común -->

<!-- Enlace a Bootstrap JS para funcionalidad -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
