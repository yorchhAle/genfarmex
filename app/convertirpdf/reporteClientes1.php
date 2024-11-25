<?php
// Incluir el archivo de configuración de base de datos para establecer la conexión
require '../../config/db.php';
$conn = getConnection(); // Obtener conexión desde la función definida en db.php

// Configuración de los encabezados HTTP para forzar la descarga de un archivo Excel
header('Content-Type:application/xls'); // Tipo de contenido Excel
header('Content-Disposition: attachment; filename=reporte_clientes.xls'); // Nombre del archivo descargado

?>
<!-- Encabezado del reporte -->
<h1>Reporte de Clientes</h1>

<!-- Tabla HTML que contendrá los datos del reporte -->
<table border="1"> <!-- El atributo "border" asegura que las celdas tengan borde visible -->
    <thead> <!-- Encabezado de la tabla -->
        <tr>
            <!-- Definición de columnas con nombres descriptivos -->
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
    <tbody> <!-- Cuerpo de la tabla donde se insertarán los datos -->
        <?php
        // Consulta SQL para obtener datos de clientes
        $query = "SELECT u.nombre, u.apellido, u.usuario, u.pass, u.correo, u.telefono, u.direccion, c.creditoC, c.estatusC, c.fechaRegistro 
            FROM usuarios u LEFT JOIN clientes c ON u.idusuario = c.idusuario WHERE tipoUsuario = 'cliente';"; // Filtrar únicamente usuarios con tipo 'cliente'

        $resultado = mysqli_query($conn, $query); // Ejecutar la consulta

        $row_count = 0; // Inicializar un contador para las filas
        while ($row = mysqli_fetch_array($resultado)) { // Iterar sobre cada fila del resultado
            $row_count++; // Incrementar el contador por cada fila obtenida
        ?>
            <tr>
                <!-- Imprimir cada campo de la fila en una celda de la tabla -->
                <td><?php echo utf8_decode($row['nombre']); ?></td> <!-- Decodificación UTF-8 para nombres -->
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

<!-- Mostrar el total de clientes registrados al final del reporte -->
<p>Total de clientes registrados: <?php echo $row_count; ?></p>
