<?php
session_start();
require_once __DIR__ . '/../models/modeloUsuario.php';

class AuthController {
    public function login($usuario, $contrasena) {
        $usuarioModel = new Usuario();
        $usuarioData = $usuarioModel->obtenerPorUsuario($usuario);

        if ($usuarioData) {
            if ($contrasena === $usuarioData['pass']) {

                session_start();
                $_SESSION['usuario'] = $usuarioData['usuario'];
                $_SESSION['tipoUsuario'] = $usuarioData['tipoUsuario'];
                header("Location: panel.php");
                exit;
            } else {
                // Contraseña incorrecta
                echo "<script>alert('Contraseña incorrecta.'); window.location.href='inicioSesion.html';</script>";
            }
        } else {
            // Usuario no encontrado
            echo "<script>alert('Usuario no encontrado.'); window.location.href='inicioSesion.html';</script>";
        }
    }
}


?>
