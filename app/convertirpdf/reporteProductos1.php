<?php 
session_start();
if (!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] !== 'admin'){
    header("Location: inicioSesion.html");
    exit;
}

ob_start(); // Inicia el búfer de salida

require '../../config/db.php'; // Conexión a la base de datos
require 'plantillaTres.php'; // Incluir la plantilla para generar el PDF
$conn = getConnection(); 

// Verificar conexión
if (!$conn) {
    die("Error: Conexión a la base de datos no establecida.");
}

// Consulta SQL para obtener todos los productos
$query = "SELECT id, clave, descripcion, existencias, precioUnitario FROM producto;";
$resultado = mysqli_query($conn, $query);

// Consulta SQL para contar la cantidad total de productos
$countQuery = "SELECT COUNT(*) as total FROM producto;";
$countResult = mysqli_query($conn, $countQuery);
$countRow = mysqli_fetch_assoc($countResult);
$totalProductos = $countRow['total']; // Cantidad total de productos

// Crear el PDF
$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// Título del Reporte
$pdf->SetFillColor(38, 120, 178); // Azul oscuro
$pdf->SetTextColor(255, 255, 255); // Blanco
$pdf->Cell(0, 10, 'Reporte de Productos', 0, 1, 'C', true);
$pdf->Ln(5);

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(232, 232, 232); // Gris claro
$pdf->SetTextColor(0); // Negro

$header = ['ID', 'Clave', 'Descripcion', 'Existencias', 'Precio Unitario'];
$widths = [20, 30, 60, 30, 30, 30];

foreach ($header as $index => $col) {
    $pdf->Cell($widths[$index], 10, $col, 1, 0, 'C', true);
}
$pdf->Ln();

// Cuerpo de la tabla
$pdf->SetFont('Arial', '', 10);
$fill = false; // Alternar colores de fila
while ($row = mysqli_fetch_array($resultado)) {
    $pdf->SetFillColor(245, 245, 245); // Gris muy claro
    $pdf->Cell($widths[0], 10, $row['id'], 1, 0, 'C', $fill);
    $pdf->Cell($widths[1], 10, utf8_decode($row['clave']), 1, 0, 'C', $fill);
    $pdf->Cell($widths[2], 10, utf8_decode($row['descripcion']), 1, 0, 'C', $fill);
    $pdf->Cell($widths[3], 10, $row['existencias'], 1, 0, 'C', $fill);
    $pdf->Cell($widths[4], 10, '$' . number_format($row['precioUnitario'], 2), 1, 0, 'C', $fill);
    $pdf->Ln();
    $fill = !$fill; // Alternar color de fondo
}

// Agregar el conteo total al final
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, "Cantidad total de productos: $totalProductos", 0, 1, 'C');

// Salida del PDF
$pdf->Output();

ob_end_flush(); // Finaliza y limpia el búfer de salida
?>
