<?php

// Datos de conexión
$db_host = 'localhost';
$db_name = 'genfarmexbd';
$db_user = 'root';
$db_pass = '';

// Nombre del archivo de respaldo
$fecha = date("Ymd-His");
$salida_sql = $db_name . '_' . $fecha . '.sql';

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
?>
