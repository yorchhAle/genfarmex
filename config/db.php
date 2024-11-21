<?php
function getConnection() {
    $host = "localhost";
    $user = "root"; 
    $password = ""; 
    $dbname = "genfarmexBD";

    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    return $conn;
}
?>
