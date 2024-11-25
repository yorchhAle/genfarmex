<?php
// Iniciar sesión para verificar permisos de administrador
session_start();

// Verificar si el usuario tiene permisos de administrador
if (!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] !== 'admin' && $_SESSION['tipoUsuario'] !== 'empleado'){
    header("Location: inicioSesion.html");
    exit;
}

// Incluir el encabezado común del proyecto
include '../includes/header.php'; // Incluir el encabezado
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de clientes</title>
    <!-- Enlace a Bootstrap CSS para estilos responsivos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/reportes.css"> <!-- Enlace a CSS personalizado -->
</head>

<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->

    <!-- Contenedor principal -->
    <div class="container">
        <!-- Tarjeta del formulario -->
        <div class="form-card mx-auto col-md-6">
            <h1 class="text-center mb-4">Generar reportes de proveedores</h1>
            <p align="center">Genere reportes personalizados de proveedores según su correo.</p>
            <!-- Formulario para generación de reportes -->
            <form action="../convertirpdf/reporteProveedores1.php" method="POST">
                <!-- Campo para buscar por correo -->
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo a buscar</label>
                    <input type="text" class="form-control" id="correo" name="correo">
                </div>

                <!-- Botones del formulario -->
                <div class="d-flex justify-content-between">
                    <a href="reportesPanel.php" class="btn btn-secondary">Regresar</a>
                    <div>
                        <button type="submit" name="generarConParametros" class="btn btn-primary">Generar con parámetros</button>
                    </div>
                </div>
            </form>
            <br>
            <!-- Botón para generar sin parámetros -->
            <div class="d-flex justify-content-between">
                <div>
                    <button type="submit" name="generarSinParametros" class="btn btn-primary me-2">
                        <a href="../convertirpdf/reporteProveedores1.php" style="color: white;">Generar sin parámetros</a>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->

    <!-- Enlace a Bootstrap JS para funcionalidades dinámicas -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
