<?php
include '../config/db.php';

if(!
$restorePoint = SGBD::limpiarCadena($_POST['restorePoint'])){
    echo "<script>alert('No se pudo restaurar la base de datos, ingrese un archivo sql válido.'); window.location.href='index.php';</script>";
}
$totalErrors = 0;

if (!file_exists($restorePoint)) {
    die("Error: El archivo de respaldo no existe en la ruta especificada.");
}

$sqlContent = file_get_contents($restorePoint);
$sqlContent = str_replace("CREATE TABLE ", "CREATE TABLE IF NOT EXISTS ", $sqlContent);
$sql = explode(";", $sqlContent);

set_time_limit(300);

$con = mysqli_connect(SERVER, USER, PASS, BD);
$con->query("SET FOREIGN_KEY_CHECKS=0");

// Vaciar todas las tablas de la base de datos
$tables = $con->query("SHOW TABLES");
while ($table = $tables->fetch_array()) {
    $con->query("TRUNCATE TABLE `" . $table[0] . "`");
}

// Ejecutar las consultas de restauración
for ($i = 0; $i < (count($sql) - 1); $i++) {
    if (!$con->query($sql[$i] . ";")) {
        $totalErrors++;
        echo "Error en la consulta {$i}: " . mysqli_error($con) . "<br>";
    }
}

$con->query("SET FOREIGN_KEY_CHECKS=1");
$con->close();

if ($totalErrors <= 0) {
    echo "<script>alert('Restauración compleatada con éxito.'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('La restauración no se pudo completar.'); window.location.href='index.php';</script>";
}
?>
