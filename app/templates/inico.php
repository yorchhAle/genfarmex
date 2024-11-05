<?php
require_once '../controllers/usuarioContrlador.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    if ($usuario && $contrasena) {
        $auth = new AuthController();
        $auth->login($usuario, $contrasena);
    } else {
        echo "<script>alert('Por favor, llena ambos campos.'); window.location.href='inicioSesion.html';</script>";
    }
} else {
    header("Location: panel.php");
    exit;
}

?>