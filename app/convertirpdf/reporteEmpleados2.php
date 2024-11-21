<?php
require 'plantillaDos.php';
require '../../config/db.php';
$conn = getConnection();

// Verificar conexión
if (!$conn) {
    die("Error: Conexión a la base de datos no establecida.");
}

// Obtener parámetros del formulario
$fechaInicio = $_POST['fechaInicio'] ?? null;
$fechaFin = $_POST['fechaFin'] ?? null;
$rol = $_POST['rol'] ?? null; // Parámetro para el rol del empleado

// Construir consulta SQL dinámicamente
$query = "SELECT u.nombre, u.apellido, u.correo, u.telefono, u.direccion, e.rol, e.sueldo, e.fechaContratacion FROM usuarios u 
LEFT JOIN empleados e ON u.idusuario = e.idusuario WHERE tipoUsuario = 'empleado'";

$conditions = [];
if ($fechaInicio) {
    $conditions[] = "e.fechaContratacion >= '$fechaInicio'";
}
if ($rol) {
    $conditions[] = "e.rol = '$rol'";
}

// Añadir condiciones a la consulta si existen
if (!empty($conditions)) {
    $query .= " AND " . implode(" AND ", $conditions);
}

$resultado = mysqli_query($conn, $query);

// Crear el PDF
$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// Título del Reporte
$pdf->SetFillColor(38, 120, 178); // Azul oscuro
$pdf->SetTextColor(255, 255, 255); // Blanco
$pdf->Cell(0, 10, 'Reporte de Empleados Filtrado', 0, 1, 'C', true);
$pdf->Ln(5);

// Encabezados de tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(37, 150, 190); // azul claro
$pdf->SetTextColor(0); // Negro

$header = ['Nombre', 'Apellido', 'Telefono', 'Direccion', 'Contratacion', 'Rol', 'Sueldo'];
$widths = [25, 25, 40, 25, 30, 30, 20, 15]; // Ajustado para sumar <= 190 mm

foreach ($header as $index => $col) {
    $pdf->Cell($widths[$index], 8, $col, 1, 0, 'C', true);
}
$pdf->Ln();

// Cuerpo de la tabla
$pdf->SetFont('Arial', '', 8); // Reducido para que todo entre bien
$fill = false; // Alternar colores de fila
while ($row = mysqli_fetch_array($resultado)) {
    $pdf->SetFillColor(245, 245, 245); // Gris muy claro
    $pdf->Cell($widths[0], 8, utf8_decode($row['nombre']), 1, 0, 'C', $fill);
    $pdf->Cell($widths[1], 8, utf8_decode($row['apellido']), 1, 0, 'C', $fill);
    $pdf->Cell($widths[3], 8, $row['telefono'], 1, 0, 'C', $fill);
    $pdf->Cell($widths[4], 8, utf8_decode($row['direccion']), 1, 0, 'C', $fill);
    $pdf->Cell($widths[5], 8, $row['fechaContratacion'], 1, 0, 'C', $fill);
    $pdf->Cell($widths[6], 8, utf8_decode($row['rol']), 1, 0, 'C', $fill);
    $pdf->Cell($widths[7], 8, '$' . number_format($row['sueldo'], 2), 1, 0, 'C', $fill);
    $pdf->Ln();
    $fill = !$fill; // Alternar color de fondo
}

// Salida del PDF
$pdf->Output();
?>
