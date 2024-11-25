<?php
// Incluir la plantilla para la creación de PDFs
require 'plantillaDos.php';

// Conectar a la base de datos
require '../../config/db.php';
$conn = getConnection(); 

// Verificar si la conexión a la base de datos fue exitosa
if (!$conn) {
    die("Error: Conexión a la base de datos no establecida.");
}

// Obtener los parámetros enviados desde el formulario (si existen)
$fechaInicio = $_POST['fechaInicio'] ?? null;
$fechaFin = $_POST['fechaFin'] ?? null;
$rol = $_POST['rol'] ?? null;

// Construir la consulta SQL base
$query = "SELECT u.nombre, u.apellido, u.correo, u.telefono, u.direccion, e.rol, e.sueldo, e.fechaContratacion 
          FROM usuarios u 
          LEFT JOIN empleados e ON u.idusuario = e.idusuario 
          WHERE u.tipoUsuario = 'empleado'";

// Crear condiciones dinámicas basadas en los parámetros recibidos
$conditions = [];
if ($fechaInicio) {
    $conditions[] = "e.fechaContratacion >= '$fechaInicio'";
}
if ($fechaFin) {
    $conditions[] = "e.fechaContratacion <= '$fechaFin'";
}
if ($rol) {
    $conditions[] = "e.rol = '$rol'";
}

// Si existen condiciones, añadirlas a la consulta
if (!empty($conditions)) {
    $query .= " AND " . implode(" AND ", $conditions);
}

// Ejecutar la consulta en la base de datos
$resultado = mysqli_query($conn, $query);

// Crear una nueva instancia del PDF
$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AliasNbPages(); // Agregar funcionalidad de número de páginas
$pdf->AddPage(); // Crear una nueva página
$pdf->SetFont('Arial', 'B', 14); // Establecer la fuente

// Título del reporte
$pdf->SetFillColor(38, 120, 178); // Color de fondo (azul oscuro)
$pdf->SetTextColor(255, 255, 255); // Color del texto (blanco)
$pdf->Cell(0, 10, 'Reporte de Empleados', 0, 1, 'C', true); // Celda para el título
$pdf->Ln(5); // Salto de línea

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(232, 232, 232); // Color de fondo de los encabezados (gris claro)
$pdf->SetTextColor(0); // Color del texto (negro)

// Definir los encabezados y los anchos de las columnas
$header = ['Nombre', 'Apellido', 'Teléfono', 'Dirección', 'Contratación', 'Rol', 'Sueldo'];
$widths = [30, 30, 30, 40, 30, 20, 20]; // Ajustado para ocupar 190 mm de ancho total

// Crear las celdas de encabezados
foreach ($header as $index => $col) {
    $pdf->Cell($widths[$index], 8, utf8_decode($col), 1, 0, 'C', true);
}
$pdf->Ln(); // Salto de línea después de los encabezados

// Cuerpo de la tabla
$pdf->SetFont('Arial', '', 9); // Fuente para los datos
$fill = false; // Alternar colores de fondo de las filas
$totalRegistros = 0; // Contador de registros

// Procesar cada fila de resultados
while ($row = mysqli_fetch_array($resultado)) {
    $pdf->SetFillColor(245, 245, 245); // Color de fondo para filas alternas (gris muy claro)
    $pdf->Cell($widths[0], 8, utf8_decode($row['nombre']), 1, 0, 'C', $fill);
    $pdf->Cell($widths[1], 8, utf8_decode($row['apellido']), 1, 0, 'C', $fill);
    $pdf->Cell($widths[2], 8, $row['telefono'], 1, 0, 'C', $fill);
    $pdf->Cell($widths[3], 8, utf8_decode($row['direccion']), 1, 0, 'C', $fill);
    $pdf->Cell($widths[4], 8, $row['fechaContratacion'], 1, 0, 'C', $fill);
    $pdf->Cell($widths[5], 8, utf8_decode($row['rol']), 1, 0, 'C', $fill);
    $pdf->Cell($widths[6], 8, '$' . number_format($row['sueldo'], 2), 1, 0, 'C', $fill);
    $pdf->Ln(); // Salto de línea después de cada fila
    $fill = !$fill; // Alternar color de fondo
    $totalRegistros++; // Incrementar contador de registros
}

// Agregar el total de registros al final del reporte
$pdf->Ln(5); // Salto de línea adicional
$pdf->SetFont('Arial', 'B', 10); // Fuente en negrita
$pdf->Cell(0, 10, "Total de registros: $totalRegistros", 0, 1, 'R'); // Mostrar el total alineado a la derecha

// Generar y mostrar el PDF
$pdf->Output();
?>
