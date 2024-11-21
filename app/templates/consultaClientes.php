<?php
include '../../config/db.php'; // Incluye tu archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fechaInicio = $_POST['fechaInicio'] ?? null;
    $fechaFin = $_POST['fechaFin'] ?? null;
    $estatus = $_POST['estatus'] ?? null;

    // Construir consulta con los parámetros
    $query = "SELECT * FROM clientes WHERE 1=1";
    if ($fechaInicio) $query .= " AND fechaRegistro >= '$fechaInicio'";
    if ($fechaFin) $query .= " AND fechaRegistro <= '$fechaFin'";
    if ($estatus) $query .= " AND estatusC = '$estatus'";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<table class='table table-striped'>";
        echo "<thead><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Fecha Registro</th><th>Estatus</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['fecha_registro'] . "</td>";
            echo "<td>" . $row['estatus'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p class='text-danger'>No se encontraron resultados.</p>";
    }
}
?>
