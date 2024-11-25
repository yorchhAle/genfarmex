<?php
// Incluir archivo de configuración para conexión a la base de datos
require '../../config/db.php';
$conn = getConnection(); // Establecer conexión con la base de datos

// Verificar si la conexión fue exitosa
if (!$conn) {
    die("Error: Conexión a la base de datos no establecida."); // Mensaje en caso de error
}

// Configurar encabezados HTTP para forzar la descarga de un archivo Excel
header('Content-Type: application/xls'); // Tipo de contenido para Excel
header('Content-Disposition: attachment; filename=reporte_clientes_filtrado.xls'); // Nombre del archivo descargado

// Obtener parámetros enviados desde el formulario de filtrado
$fechaInicio = $_POST['fechaInicio'] ?? null; // Fecha inicial del rango
$fechaFin = $_POST['fechaFin'] ?? null;       // Fecha final del rango
$estatus = $_POST['estatus'] ?? null;         // Estatus de clientes a filtrar

// Construir consulta SQL base para obtener datos de clientes
$query = "SELECT 
            u.nombre, 
            u.apellido, 
            u.usuario, 
            u.pass, 
            u.correo, 
            u.telefono, 
            u.direccion, 
            c.creditoC, 
            c.estatusC, 
            c.fechaRegistro 
          FROM 
            usuarios u 
          LEFT JOIN 
            clientes c 
          ON 
            u.idusuario = c.idusuario 
          WHERE 
            u.tipoUsuario = 'cliente'"; // Solo obtener usuarios con tipo 'cliente'

// Array para almacenar condiciones de filtro
$conditions = [];
if ($fechaInicio) {
    $conditions[] = "c.fechaRegistro >= '$fechaInicio'"; // Filtrar registros desde esta fecha
}
if ($fechaFin) {
    $conditions[] = "c.fechaRegistro <= '$fechaFin'"; // Filtrar registros hasta esta fecha
}
if ($estatus) {
    $conditions[] = "c.estatusC = '$estatus'"; // Filtrar por estatus específico
}

// Si hay condiciones de filtro, agregarlas a la consulta SQL
if (!empty($conditions)) {
    $query .= " AND " . implode(" AND ", $conditions); // Concatenar condiciones con 'AND'
}

// Ejecutar la consulta SQL
$resultado = mysqli_query($conn, $query);

?>
<!-- Encabezado del reporte -->
<h1>Reporte de Clientes Filtrado</h1>

<!-- Tabla HTML para mostrar los datos -->
<table border="1"> <!-- El atributo "border" ayuda a visualizar las celdas en Excel -->
    <thead> <!-- Definición de las columnas de la tabla -->
        <tr>
            <td>Nombre</td>
            <td>Apellido</td>
            <td>Correo</td>
            <td>Telefono</td>
            <td>Direccion</td>
            <td>Credito</td>
            <td>Estatus</td>
            <td>Fecha Registro</td>
        </tr>
    </thead>
    <tbody> <!-- Cuerpo de la tabla donde se insertan los datos -->
        <?php
        $row_count = 0; // Contador para el número de filas
        while ($row = mysqli_fetch_array($resultado)) { // Iterar sobre cada fila del resultado
            $row_count++; // Incrementar el contador de filas
        ?>
            <tr>
                <!-- Imprimir cada campo de la fila en una celda -->
                <td><?php echo utf8_decode($row['nombre']); ?></td> <!-- Decodificar texto UTF-8 -->
                <td><?php echo utf8_decode($row['apellido']); ?></td>
                <td><?php echo utf8_decode($row['correo']); ?></td>
                <td><?php echo $row['telefono']; ?></td>
                <td><?php echo utf8_decode($row['direccion']); ?></td>
                <td><?php echo $row['creditoC']; ?></td>
                <td><?php echo $row['estatusC']; ?></td>
                <td><?php echo $row['fechaRegistro']; ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<!-- Mostrar el total de clientes encontrados -->
<p>Total de clientes encontrados: <?php echo $row_count; ?></p>
