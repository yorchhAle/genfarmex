<?php
require_once '../controllers/usuarioContrlador.php';
// Incluye el archivo del controlador de usuarios, donde está definida la lógica de autenticación y manejo de usuarios.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si la solicitud fue enviada usando el método POST, asegurando que proviene del formulario de inicio de sesión.

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    // Recupera los datos enviados desde el formulario a través de los campos 'usuario' y 'contrasena'.

    if ($usuario && $contrasena) {
        // Comprueba que ambos campos ('usuario' y 'contrasena') no estén vacíos.

        $auth = new AuthController();
        // Crea una instancia de la clase AuthController, que contiene la lógica para manejar el inicio de sesión.

        $auth->login($usuario, $contrasena);
        // Llama al método 'login' del controlador AuthController, pasando como parámetros el usuario y la contraseña.
    } else {
        // Si alguno de los campos está vacío, muestra un mensaje de error y redirige al formulario de inicio de sesión.

        echo "<script>alert('Por favor, llena ambos campos.'); window.location.href='../views/inicioSesion.html';</script>";
        // Utiliza JavaScript para mostrar un mensaje de alerta y redirigir de vuelta al formulario de inicio de sesión.
    }
} else {
    // Si el script se accede usando un método diferente a POST (por ejemplo, GET), redirige a la página principal.

    header("Location: panel.php");
    // Redirige al usuario a 'panel.php', posiblemente la página principal para usuarios autenticados.

    exit;
    // Detiene la ejecución del script después de la redirección para asegurarse de que no se ejecuten más instrucciones.
}
