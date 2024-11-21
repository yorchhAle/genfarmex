<?php
// Datos de conexión
$db_host = 'localhost';
$db_name = 'genfarmexbd';
$db_user = 'root';
$db_pass = '';

<<<<<<< HEAD:respaldos/generarRespaldo.php
// Nombre del archivo de respaldo
$fecha = date("Y-m-d_h-i-s");
$salida_sql = $db_name . '_' . $fecha . '.sql';
=======
// Nombre del archivo de respaldo y ruta de la carpeta de respaldo
$fecha = date("Ymd-His");
$carpeta_backup = 'backup';
$salida_sql = $carpeta_backup . '/' . $db_name . '_' . $fecha . '.sql';

// Crear la carpeta si no existe
if (!file_exists($carpeta_backup)) {
    mkdir($carpeta_backup, 0777, true);
}
>>>>>>> 36167dfa535c78088b875c03b15f29834aeebeee:app/respaldos/generarRespaldo.php

// Conectar a la base de datos
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Abrir archivo para escritura
$file = fopen($salida_sql, 'w');

if ($file === false) {
    die("No se pudo crear el archivo de respaldo.");
}

// Obtener todas las tablas de la base de datos
$tables = $conn->query("SHOW TABLES");
while ($table = $tables->fetch_array()) {
    $table_name = $table[0];
    
    // Obtener la estructura de la tabla
    $create_table = $conn->query("SHOW CREATE TABLE `$table_name`")->fetch_assoc();
    fwrite($file, "\n\n" . $create_table['Create Table'] . ";\n\n");
    
    // Obtener los datos de la tabla
    $rows = $conn->query("SELECT * FROM `$table_name`");
    while ($row = $rows->fetch_assoc()) {
        $values = array_map([$conn, 'real_escape_string'], array_values($row));
        $values = "'" . implode("', '", $values) . "'";
        fwrite($file, "INSERT INTO `$table_name` VALUES ($values);\n");
    }
}

// Cerrar el archivo y la conexión
fclose($file);
$conn->close();

echo "Respaldo creado: $salida_sql";
<<<<<<< HEAD:respaldos/generarRespaldo.php
header('Location:')
=======
echo "<script>alert('Respaldo creado. $salida_sql'); window.location.href='index.php';</script>";
>>>>>>> 36167dfa535c78088b875c03b15f29834aeebeee:app/respaldos/generarRespaldo.php
?>
