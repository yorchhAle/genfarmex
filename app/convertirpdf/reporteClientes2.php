<?php
require 'plantilla.php';
require '../../config/db.php';
$conn = getConnection();

// Verificar conexión
if (!$conn) {
    die("Error: Conexión a la base de datos no establecida.");
}

// Obtener parámetros del formulario
$fechaInicio = $_POST['fechaInicio'] ?? null;
$fechaFin = $_POST['fechaFin'] ?? null;
$estatus = $_POST['estatus'] ?? null;

// Construir consulta SQL dinámicamente
$query = "SELECT u.nombre, u.apellido, u.usuario, u.pass, u.correo, u.telefono, u.direccion, 
                 c.creditoC, c.estatusC, c.fechaRegistro 
          FROM usuarios u 
          LEFT JOIN clientes c ON u.idusuario = c.idusuario 
          WHERE u.tipoUsuario = 'cliente'";

$conditions = [];
if ($fechaInicio) {
    $conditions[] = "c.fechaRegistro >= '$fechaInicio'";
}
if ($fechaFin) {
    $conditions[] = "c.fechaRegistro <= '$fechaFin'";
}
if ($estatus) {
    $conditions[] = "c.estatusC = '$estatus'";
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
$pdf->SetFont('Arial', 'B', 12);

// Encabezados de tabla
$pdf->SetFillColor(232, 232, 232);
$pdf->Cell(30, 10, 'Nombre', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Apellido', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Correo', 1, 0, 'C', true);
$pdf->Cell(25, 10, 'Telefono', 1, 0, 'C', true);
$pdf->Cell(35, 10, 'Direccion', 1, 0, 'C', true);
$pdf->Cell(20, 10, 'Credito', 1, 0, 'C', true);
$pdf->Cell(20, 10, 'Estatus', 1, 0, 'C', true);
$pdf->Ln();

// Cuerpo de la tabla
$pdf->SetFont('Arial', '', 10);
while ($row = mysqli_fetch_array($resultado)) {
    $pdf->Cell(30, 10, utf8_decode($row['nombre']), 1, 0, 'C');
    $pdf->Cell(30, 10, utf8_decode($row['apellido']), 1, 0, 'C');
    $pdf->Cell(40, 10, utf8_decode($row['correo']), 1, 0, 'C');
    $pdf->Cell(25, 10, $row['telefono'], 1, 0, 'C');
    $pdf->Cell(35, 10, utf8_decode($row['direccion']), 1, 0, 'C');
    $pdf->Cell(20, 10, $row['creditoC'], 1, 0, 'C');
    $pdf->Cell(20, 10, $row['estatusC'], 1, 0, 'C');
    $pdf->Ln();
}

// Salida del PDF
$pdf->Output();
?>
