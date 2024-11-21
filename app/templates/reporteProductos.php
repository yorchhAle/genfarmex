<?php 
session_start();
if (!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] !== 'admin'){
    header("Location: inicioSesion.html");
    exit;
}
include '../includes/header.php'; // Incluir el encabezado
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de clientes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/reportes.css">k
    
</head>
<body>
<?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->
<br><br><br><br>

<div class="container">
    <div class="form-card mx-auto col-md-6">
        <h1 class="text-center mb-4">Generar reportes de productos</h1>
        <p align="center">Genere reportes personalizados de productos según su categoria.</p>
        <form action="../convertirpdf/reporteProductos2.php" method="POST">

            <div class="mb-3">
                <label for="cate" class="form-label">Categoria a buscar</label>
                <input type="text" class="form-control" id="cate" name="cate">
            </div>
                

            <div class="d-flex justify-content-between">
                <a href="reportesPanel.php" class="btn btn-secondary">Regresar</a>
                <div>
                    <button type="submit" name="generarConParametros" class="btn btn-primary">Generar con parámetros</button>
                </div>
            </div>
        </form>
        <br>
        <div class="d-flex justify-content-between">
                <div>
                    <button type="submit" name="generarSinParametros" class="btn btn-primary me-2"><a href="../convertirpdf/reporteProductos1.php"style="color: white;">Generar sin parámetros</a></button>
                </div>
            </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>