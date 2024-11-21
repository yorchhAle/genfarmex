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
    <link rel="stylesheet" href="../static/css/reportes.css">
    
</head>
<body>
<?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->


<div class="container">
    <div class="form-card mx-auto col-md-6">
        <h1 class="text-center mb-4">Generar reportes de clientes</h1>
        <p align="center">Genere reportes personalizados de clientes según su fecha de registro y el estado de su cuenta.</p>
        <form action="../convertirpdf/reporteClientes2.php" method="POST">
            <div class="mb-3">
                <label for="fechaInicio" class="form-label">Fecha de inicio</label>
                <input type="date" class="form-control" id="fechaInicio" name="fechaInicio">
            </div>
            <div class="mb-3">
                <label for="fechaFin" class="form-label">Fecha de fin</label>
                <input type="date" class="form-control" id="fechaFin" name="fechaFin">
            </div>

            <div class="mb-3">
                <label for="estatus" class="form-label">Estatus de cuenta</label>
                <select class="form-select" id="estatus" name="estatus">
                    <option value="">Todos</option>
                    <option value="activo">Activo</option>
                    <option value="baja">Baja</option>
                </select>
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
                    <button type="submit" name="generarSinParametros" class="btn btn-primary me-2"><a href="../convertirpdf/reporteClientes1.php" style="color: white;">Generar sin parámetros</a></button>
                </div>
            </div>
    </div>
</div>
<br>
<br>
<script>
    // Función para validar que la fecha de fin no sea antes que la fecha de inicio
    document.querySelector('form').addEventListener('submit', function(event) {
        const fechaInicio = document.getElementById('fechaInicio').value;
        const fechaFin = document.getElementById('fechaFin').value;

        // Verificar si las fechas son válidas y comparar
        if (fechaInicio && fechaFin) {
            if (new Date(fechaFin) < new Date(fechaInicio)) {
                event.preventDefault();  // Evitar el envío del formulario
                alert("La fecha de fin no puede ser antes que la fecha de inicio.");
            }
        }
    });
</script>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
