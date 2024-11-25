<?php
session_start(); 
// Inicia o reanuda una sesión existente para poder acceder a las variables de sesión.
$_SESSION = [];
// Vacía todas las variables de la sesión actual. Esto no destruye la sesión en sí, pero elimina su contenido.
session_destroy();
// Destruye completamente la sesión actual, eliminando los datos del lado del servidor asociados con esta.
header("Location: ../index.html");
// Redirige al usuario a la página principal (index.html). 
// Esto es útil para llevar al usuario fuera de la página que estaba protegida por la sesión.
exit;
// Detiene la ejecución del script después de la redirección para evitar que se ejecuten más instrucciones.
