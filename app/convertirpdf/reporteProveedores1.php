<?php
require 'plantillaCuatro.php';
require '../../config/db.php';
$conn = getConnection(); 

// Verificar conexión
if (!$conn) {
    die("Error: Conexión a la base de datos no establecida.");
}

// Obtener el parámetro de correo desde el formulario
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';

// Si se proporcionó un correo, realizar una consulta con filtro
if ($correo != '') {
    $query = "SELECT * FROM proveedores WHERE correoP LIKE '%$correo%';";  // Filtro por correo
} else {
    $query = "SELECT * FROM proveedores;";  // Sin filtro
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
$pdf->Cell(0, 10, 'Reporte de proveedores', 0, 1, 'C', true);
$pdf->Ln(5);

// Encabezados de tabla
$pdf->SetFont('Arial', 'B', 10); // Fuente más pequeña para ajustarse
$pdf->SetFillColor(232, 232, 232); // Gris claro
$pdf->SetTextColor(0); // Negro

// Ajustar ancho de columnas para que quepan bien en la página
$header = ['Nombre', 'Contacto', 'Teléfono', 'Correo', 'Dirección'];
$widths = [25, 25, 35, 35, 60]; // Aumentamos la columna de Dirección a 60

foreach ($header as $index => $col) {
    $pdf->Cell($widths[$index], 8, utf8_decode($col), 1, 0, 'C', true);
}
$pdf->Ln();

// Cuerpo de la tabla
$pdf->SetFont('Arial', '', 9); // Fuente más pequeña para contenido
$fill = false; // Alternar colores de fila
while ($row = mysqli_fetch_array($resultado)) {
    $pdf->SetFillColor(245, 245, 245); // Gris muy claro
    $pdf->Cell($widths[0], 8, utf8_decode($row['nombreP']), 1, 0, 'C', $fill);
    $pdf->Cell($widths[1], 8, utf8_decode($row['contactoP']), 1, 0, 'C', $fill);
    $pdf->Cell($widths[2], 8, $row['telefonoP'], 1, 0, 'C', $fill);
    $pdf->Cell($widths[3], 8, utf8_decode($row['correoP']), 1, 0, 'C', $fill);
    $pdf->Cell($widths[4], 8, utf8_decode($row['direccionP']), 1, 0, 'C', $fill);
    $pdf->Ln();
    $fill = !$fill; // Alternar color de fondo
}

// Salida del PDF
$pdf->Output();
?>
